export class HttpError extends Error {
    constructor(status, message) {
        super(message);
        this.status = status;
    }
}
export const fail = (status, message) => {
    throw new HttpError(status, message);
};
export const hex = (bytes) =>
    Array.from(new Uint8Array(bytes), (b) =>
        b.toString(16).padStart(2, "0"),
    ).join("");
const unhex = (text) =>
    new Uint8Array(text.match(/../g).map((x) => parseInt(x, 16)));
export const random = () => hex(crypto.getRandomValues(new Uint8Array(32)));
export const digest = async (text) =>
    hex(await crypto.subtle.digest("SHA-256", new TextEncoder().encode(text)));
export async function passwordHash(password, salt = random()) {
    const key = await crypto.subtle.importKey(
        "raw",
        new TextEncoder().encode(password),
        "PBKDF2",
        false,
        ["deriveBits"],
    );
    const hash = hex(
        await crypto.subtle.deriveBits(
            {
                name: "PBKDF2",
                salt: unhex(salt),
                iterations: 100000,
                hash: "SHA-256",
            },
            key,
            256,
        ),
    );
    return `pbkdf2$100000$${salt}$${hash}`;
}
export async function passwordMatches(password, hash) {
    if (!/^pbkdf2\$100000\$[a-f0-9]{64}\$[a-f0-9]{64}$/.test(hash || ""))
        return false;
    const candidate = await passwordHash(password, hash.split("$")[2]);
    let difference = 0;
    for (let i = 0; i < candidate.length; i++)
        difference |= candidate.charCodeAt(i) ^ hash.charCodeAt(i);
    return difference === 0;
}
export const permissions = {
    commercial: ["admin", "attendant"],
    content: ["admin", "editor"],
    administration: ["admin"],
};
export function authorize(c, permission) {
    if (!permissions[permission].includes(c.get("user")?.role))
        fail(403, "Você não tem permissão para acessar esta área.");
}
export async function rateLimit(sql, key, limit = 5, seconds = 60) {
    const hashed = await digest(key);
    const [row] =
        await sql`INSERT INTO cotech.worker_limits (key,hits,expires_at) VALUES (${hashed},1,now()+${seconds}*interval '1 second') ON CONFLICT (key) DO UPDATE SET hits=CASE WHEN worker_limits.expires_at<now() THEN 1 ELSE worker_limits.hits+1 END, expires_at=CASE WHEN worker_limits.expires_at<now() THEN now()+${seconds}*interval '1 second' ELSE worker_limits.expires_at END RETURNING hits`;
    if (row.hits > limit)
        fail(429, "Muitas tentativas. Aguarde um minuto e tente novamente.");
}
export function text(data, key, { required = false, min = 0, max = 190 } = {}) {
    const value = data[key];
    if (value !== undefined && typeof value !== "string")
        fail(422, `Campo inválido: ${key}.`);
    const result = key.startsWith("password") ? (value || "") : (value || "").trim();
    if (
        (required && !result) ||
        (result && result.length < min) ||
        result.length > max
    )
        fail(422, `Confira o campo ${key} (máximo ${max} caracteres).`);
    return result || null;
}
export function choice(data, key, values, fallback) {
    const value = text(data, key) || fallback;
    if (!values.includes(value)) fail(422, `Valor inválido: ${key}.`);
    return value;
}
export function integer(
    data,
    key,
    { optional = false, min = 1, max = Number.MAX_SAFE_INTEGER } = {},
) {
    const value = text(data, key);
    if (!value && optional) return null;
    if (
        !/^\d+$/.test(value || "") ||
        Number(value) < min ||
        Number(value) > max
    )
        fail(422, `Número inválido: ${key}.`);
    return Number(value);
}
export function email(data, key = "email", required = false) {
    const value = text(data, key, { required, max: 190 });
    if (value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value))
        fail(422, "Informe um e-mail válido.");
    return value?.toLowerCase() || null;
}
export function date(data, key) {
    const value = text(data, key, { max: 32 });
    if (!value) return null;
    if (
        !/^\d{4}-\d\d-\d\dT\d\d:\d\d/.test(value) ||
        !Number.isFinite(Date.parse(value + "Z"))
    )
        fail(422, "Data inválida.");
    return new Date(value + "Z");
}
export async function checkFile(file, imagesOnly = false) {
    if (!file || typeof file === "string" || !file.size) return null;
    if (file.size > 5 * 1024 * 1024)
        fail(422, "Cada arquivo deve ter no máximo 5 MB.");
    const bytes = new Uint8Array(await file.slice(0, 16).arrayBuffer());
    let mime = null;
    if (bytes[0] === 0xff && bytes[1] === 0xd8 && bytes[2] === 0xff)
        mime = "image/jpeg";
    if (hex(bytes.slice(0, 8)) === "89504e470d0a1a0a") mime = "image/png";
    const head = new TextDecoder().decode(bytes);
    if (head.startsWith("RIFF") && head.slice(8, 12) === "WEBP")
        mime = "image/webp";
    if (!imagesOnly && head.startsWith("%PDF-")) mime = "application/pdf";
    if (!mime) fail(422, "Formato inválido. Use JPG, PNG, WebP ou PDF.");
    return {
        file,
        mime,
        name: file.name.replace(/[\x00-\x1f\x7f/\\"]/g, "_").slice(0, 190),
    };
}

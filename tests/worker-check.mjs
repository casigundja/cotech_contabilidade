import assert from "node:assert/strict";
import fs from "node:fs";
import postgres from "postgres";
import { passwordHash, digest } from "../worker/security.js";
const origin = process.env.WORKER_TEST_URL || "http://127.0.0.1:8787";
if (!origin.startsWith("http://127.0.0.1:"))
    throw new Error("Mutation tests must target the local Worker.");
const config = JSON.parse(
    fs.readFileSync("storage/app/private/deploy/worker-db.json", "utf8"),
);
const sql = postgres({
    ...config,
    username: config.user,
    ssl: "require",
    max: 2,
    prepare: false,
});
const prefix = "worker-test-" + Date.now(),
    password = "Test-" + crypto.randomUUID(),
    users = [],
    contentIds = [],
    leadIds = [],
    customerIds = [],
    stageIds = [];
let originalSettings;
class Client {
    constructor(ip) {
        this.ip = ip;
        this.cookie = "";
        this.token = "";
    }
    async request(path, method = "GET", data = {}, options = {}) {
        const headers = {
            cookie: this.cookie,
            "cf-connecting-ip": this.ip,
            ...options.headers,
        };
        let body;
        if (method !== "GET") {
            headers.origin = options.origin || origin;
            body = new FormData();
            body.set("_token", this.token);
            for (const [key, value] of Object.entries(data)) {
                if (Array.isArray(value))
                    for (const entry of value) body.append(key, entry);
                else body.set(key, value);
            }
        }
        const response = await fetch(origin + path, {
            method,
            headers,
            body,
            redirect: "manual",
        });
        const cookie = response.headers.get("set-cookie");
        if (cookie) this.cookie = cookie.split(";")[0];
        const html = await response.text();
        const token = html.match(/name="_token" value="([a-f0-9]+)"/);
        if (token) this.token = token[1];
        return { status: response.status, html, headers: response.headers };
    }
    async login(user) {
        assert.equal((await this.request("/login")).status, 200);
        const result = await this.request("/login", "POST", {
            email: user.email,
            password,
        });
        assert.equal(result.status, 303, result.html);
        assert.equal(
            (await this.request("/admin")).status,
            user.role === "editor" ? 302 : 200,
        );
        if (user.role === "editor") await this.request("/admin/conteudos");
    }
}
const admin = new Client("203.0.113.10"),
    editor = new Client("203.0.113.11"),
    attendant = new Client("203.0.113.12"),
    guest = new Client("203.0.113.13");
try {
    for (const role of ["admin", "editor", "attendant"]) {
        const [user] =
            await sql`INSERT INTO cotech.users(name,email,password,role,created_at,updated_at) VALUES (${prefix},${prefix + "-" + role + "@example.invalid"},${await passwordHash(password)},${role},now(),now()) RETURNING id,email,role`;
        users.push(user);
    }
    for (const path of [
        "/",
        "/servicos",
        "/blog",
        "/orcamento",
        "/servicos/contabilidade-empresarial",
        "/blog/clareza-nas-decisoes",
        "/pagina/privacidade",
        "/login",
        "/forgot-password",
        "/reset-password/test-token",
        "/sitemap.xml",
        "/robots.txt",
        "/css/public.css",
    ]) {
        const response = await guest.request(path);
        assert.equal(
            response.status,
            200,
            path + ": " + response.html.slice(0, 300),
        );
    }
    assert.equal((await guest.request("/servicos/inexistente")).status, 404);
    assert.equal((await guest.request("/admin")).status, 302);
    await admin.login(users[0]);
    await editor.login(users[1]);
    await attendant.login(users[2]);
    for (const path of [
        "/admin",
        "/admin/leads",
        "/admin/kanban",
        "/admin/clientes",
        "/admin/solicitacoes",
        "/admin/conteudos",
        "/admin/conteudos/novo",
        "/admin/configuracoes",
    ]) {
        const result = await admin.request(path);
        assert.equal(
            result.status,
            200,
            path + ": " + result.html.slice(0, 200),
        );
    }
    assert.equal((await editor.request("/admin/leads")).status, 403);
    assert.equal((await editor.request("/admin/configuracoes")).status, 403);
    assert.equal((await attendant.request("/admin/conteudos")).status, 403);
    assert.equal((await attendant.request("/admin/configuracoes")).status, 403);
    assert.equal(
        (
            await admin.request(
                "/admin/etapas",
                "POST",
                { name: prefix, sort: "25", color: "#123456" },
                { origin: "https://evil.example" },
            )
        ).status,
        403,
    );
    assert.equal(
        (
            await admin.request("/admin/etapas", "POST", {
                _token: "invalid",
                name: prefix,
                sort: "25",
                color: "#123456",
            })
        ).status,
        419,
    );
    const png = new File(
        [
            Buffer.from(
                "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+a2ioAAAAASUVORK5CYII=",
                "base64",
            ),
        ],
        "image.png",
        { type: "image/png" },
    );
    const content = {
        type: "post",
        title: prefix,
        slug: prefix,
        body: "<script>alert(1)</script>",
        sort: "0",
        active: "1",
        image: png,
    };
    let result = await editor.request("/admin/conteudos", "POST", content);
    assert.equal(result.status, 303, result.html);
    const [item] =
        await sql`SELECT * FROM cotech.contents WHERE slug=${prefix}`;
    contentIds.push(item.id);
    result = await guest.request("/blog/" + prefix);
    assert.equal(result.status, 200);
    assert.ok(result.html.includes("&lt;script&gt;alert(1)&lt;/script&gt;"));
    assert.equal((await guest.request(item.image)).status, 200);
    result = await editor.request("/admin/conteudos/" + item.id, "POST", {
        ...content,
        image: "",
        _method: "PUT",
        published_at: "2099-01-01T00:00",
    });
    assert.equal(result.status, 303, result.html);
    assert.equal((await guest.request("/blog/" + prefix)).status, 404);
    assert.equal((await guest.request(item.image)).status, 404);
    assert.equal(
        (
            await editor.request("/admin/conteudos", "POST", {
                ...content,
                slug: prefix + "-testimonial",
                type: "testimonial",
            })
        ).status,
        422,
    );
    await guest.request(
        "/orcamento?utm_source=worker-test&utm_campaign=" + prefix,
    );
    const payload = {
        name: prefix,
        phone: "11999999999",
        email: prefix + "@example.invalid",
        message: "Solicitação de teste de integração do Worker.",
        priority: "normal",
        contact_preference: "email",
        consent: "1",
    };
    assert.equal(
        (await guest.request("/orcamento", "POST", { ...payload, consent: "" }))
            .status,
        422,
    );
    assert.equal(
        (await guest.request("/orcamento", "POST", { ...payload, email: "" }))
            .status,
        422,
    );
    assert.equal(
        (
            await guest.request("/orcamento", "POST", {
                ...payload,
                website: "spam.example",
            })
        ).status,
        422,
    );
    assert.equal(
        (
            await guest.request("/orcamento", "POST", {
                ...payload,
                attachments: new File(["fake"], "fake.png", {
                    type: "image/png",
                }),
            })
        ).status,
        422,
    );
    result = await guest.request("/orcamento", "POST", {
        ...payload,
        attachments: new File(["%PDF-1.4\nIntegration test"], "briefing.pdf", {
            type: "application/pdf",
        }),
    });
    assert.equal(result.status, 303, result.html);
    const [lead] = await sql`SELECT * FROM cotech.leads WHERE name=${prefix}`;
    leadIds.push(lead.id);
    assert.equal(lead.source, "worker-test");
    assert.equal(lead.attribution.utm_campaign, prefix);
    assert.ok(lead.consented_at);
    const [media] =
        await sql`SELECT * FROM cotech.media WHERE lead_id=${lead.id}`;
    assert.equal((await guest.request("/admin/media/" + media.id)).status, 302);
    assert.equal(
        (await editor.request("/admin/media/" + media.id)).status,
        403,
    );
    result = await admin.request("/admin/media/" + media.id);
    assert.equal(result.status, 200);
    assert.ok(result.headers.get("content-disposition").includes("attachment"));
    assert.equal(
        (await guest.request("/orcamento", "POST", payload)).status,
        429,
    );
    assert.equal(
        (
            await attendant.request("/admin/leads/" + lead.id, "POST", {
                _method: "DELETE",
            })
        ).status,
        403,
    );
    assert.equal((await admin.request("/admin/leads/" + lead.id)).status, 200);
    const [stage] =
        await sql`SELECT id FROM cotech.lead_statuses WHERE outcome IS NULL ORDER BY sort LIMIT 1`;
    result = await admin.request("/admin/leads/" + lead.id, "POST", {
        _method: "PATCH",
        status_id: String(stage.id),
        assigned_to: String(users[2].id),
        priority: "high",
    });
    assert.equal(result.status, 303, result.html);
    result = await admin.request(
        "/admin/leads/" + lead.id + "/interactions",
        "POST",
        { message: "Contato realizado." },
    );
    assert.equal(result.status, 303, result.html);
    const conversions = await Promise.all([
        admin.request("/admin/leads/" + lead.id + "/convert", "POST"),
        admin.request("/admin/leads/" + lead.id + "/convert", "POST"),
    ]);
    for (const result of conversions)
        assert.equal(result.status, 303, result.html);
    const requests =
        await sql`SELECT * FROM cotech.service_requests WHERE lead_id=${lead.id}`;
    assert.equal(requests.length, 1);
    customerIds.push(requests[0].customer_id);
    result = await admin.request(
        "/admin/solicitacoes/" + requests[0].id,
        "POST",
        { _method: "PATCH", status: "Concluída" },
    );
    assert.equal(result.status, 303, result.html);
    result = await admin.request("/admin/etapas", "POST", {
        name: prefix,
        sort: "25",
        color: "#123456",
    });
    assert.equal(result.status, 303, result.html);
    stageIds.push(
        (await sql`SELECT id FROM cotech.lead_statuses WHERE name=${prefix}`)[0]
            .id,
    );
    originalSettings = Object.fromEntries(
        (await sql`SELECT * FROM cotech.settings`).map((row) => [
            row.key,
            row.value,
        ]),
    );
    result = await admin.request("/admin/configuracoes", "POST", {
        ...Object.fromEntries(
            Object.entries(originalSettings).map(([key, value]) => [
                key,
                value || "",
            ]),
        ),
        hero_title: prefix,
    });
    assert.equal(result.status, 303, result.html);
    assert.ok((await guest.request("/")).html.includes(prefix));
    await sql`UPDATE cotech.settings SET value=${originalSettings.hero_title} WHERE key='hero_title'`;
    originalSettings = null;
    // One-time reset token consumption and session revocation.
    const token = crypto.randomUUID();
    await sql`INSERT INTO cotech.worker_reset_tokens(token,user_id,expires_at) VALUES (${await digest(token)},${users[1].id},now()+interval '1 hour')`;
    await guest.request("/reset-password/" + token);
    result = await guest.request("/reset-password", "POST", {
        token,
        password: password + "new",
        password_confirmation: password + "new",
    });
    assert.equal(result.status, 303, result.html);
    assert.equal((await editor.request("/admin/conteudos")).status, 302);
    assert.equal(
        (
            await guest.request("/reset-password", "POST", {
                token,
                password: password + "new",
                password_confirmation: password + "new",
            })
        ).status,
        422,
    );
    result = await admin.request("/admin/leads/" + lead.id, "POST", {
        _method: "DELETE",
    });
    assert.equal(result.status, 303, result.html);
    assert.equal(
        (
            await sql`SELECT * FROM cotech.worker_files WHERE media_id=${media.id}`
        ).length,
        0,
    );
    result = await admin.request("/logout", "POST");
    assert.equal(result.status, 303);
    assert.equal((await admin.request("/admin")).status, 302);
    console.log(
        "PASS: public routes, login/logout, CSRF and origin checks, role boundaries, content escaping/scheduling/images, private uploads, quote validation/rate limiting/attribution, lead updates, concurrent conversion, requests, settings and one-time password reset.",
    );
} finally {
    if (originalSettings)
        for (const [key, value] of Object.entries(originalSettings))
            await sql`UPDATE cotech.settings SET value=${value} WHERE key=${key}`;
    await sql`DELETE FROM cotech.worker_mail WHERE recipient=${prefix + "@example.invalid"} OR body LIKE ${"%" + prefix + "%"}`;
    for (const leadId of leadIds) {
        await sql`DELETE FROM cotech.worker_mail WHERE subject=${"Novo orçamento Cotech #" + leadId}`;
        await sql`DELETE FROM cotech.audit_logs WHERE entity='lead' AND entity_id=${leadId}`;
        await sql`DELETE FROM cotech.leads WHERE id=${leadId}`;
    }
    for (const itemId of contentIds)
        await sql`DELETE FROM cotech.contents WHERE id=${itemId}`;
    for (const customerId of customerIds)
        await sql`DELETE FROM cotech.customers WHERE id=${customerId}`;
    for (const stageId of stageIds)
        await sql`DELETE FROM cotech.lead_statuses WHERE id=${stageId}`;
    for (const user of users) {
        await sql`DELETE FROM cotech.audit_logs WHERE user_id=${user.id}`;
        await sql`DELETE FROM cotech.users WHERE id=${user.id}`;
    }
    await sql.end();
}

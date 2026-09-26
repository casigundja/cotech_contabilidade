import { Hono } from "hono";
import { getCookie, setCookie } from "hono/cookie";
import postgres from "postgres";
import { Buffer } from "node:buffer";
import {
    HttpError,
    fail,
    random,
    digest,
    passwordHash,
    passwordMatches,
    authorize,
    rateLimit,
    text,
    choice,
    integer,
    email,
    date,
    checkFile,
} from "./security.js";
import {
    esc,
    layout,
    home,
    quote,
    pageHead,
    serviceCards,
    postCards,
    input,
    textarea,
    select,
    form,
    table,
    options,
    types,
    roles,
    priorities,
    stamp,
    leadTable,
    contentForm,
} from "./views.js";

const app = new Hono();
const db = (c) => c.get("sql");
const body = (c) => c.get("body");
const id = (c) => integer({ id: c.req.param("id") }, "id");
const published = (sql) =>
    sql`active=true AND (published_at IS NULL OR published_at<=now()) AND (ends_at IS NULL OR ends_at>now())`;
const audit = (sql, c, action, entity, entityId = null) =>
    sql`INSERT INTO cotech.audit_logs (user_id,action,entity,entity_id,created_at,updated_at) VALUES (${c.get("user")?.id || null},${action},${entity},${entityId},now(),now())`;
const redirect = (c, path, ok = "saved") =>
    c.redirect(path + (path.includes("?") ? "&" : "?") + "ok=" + ok, 303);
const requireRow = (row) => {
    if (!row) fail(404, "Registro não encontrado.");
    return row;
};
const page = (c) =>
    Math.max(1, Math.min(100000, Math.floor(Number(c.req.query("page"))) || 1));
const pager = (c, count, size = 25) => {
    const p = page(c),
        url = new URL(c.req.url);
    return `<div class="pagination">${p > 1 ? (url.searchParams.set("page", p - 1), `<a href="${esc(url.pathname + url.search)}">← Anterior</a>`) : ""} <span>Página ${p}</span> ${count === size ? (url.searchParams.set("page", p + 1), `<a href="${esc(url.pathname + url.search)}">Próxima →</a>`) : ""}</div>`;
};
const cookieOptions = (c) => ({
    httpOnly: true,
    secure: new URL(c.req.url).protocol === "https:",
    sameSite: "Lax",
    path: "/",
    maxAge: 7200,
});
async function newSession(c, userId = null, data = {}) {
    const token = random(),
        session = {
            id: await digest(token),
            csrf: random(),
            user_id: userId,
            data,
        };
    await db(
        c,
    )`INSERT INTO cotech.worker_sessions (id,user_id,csrf,data,expires_at) VALUES (${session.id},${userId},${session.csrf},${db(c).json(data)},now()+interval '2 hours')`;
    setCookie(c, "cotech_session", token, cookieOptions(c));
    c.set("session", session);
    return session;
}
async function mail(sql, to, subject, message) {
    if (to)
        await sql`INSERT INTO cotech.worker_mail(recipient,subject,body) VALUES (${to},${subject},${message})`;
}
app.use("*", async (c, next) => {
    c.header("X-Content-Type-Options", "nosniff");
    c.header("X-Frame-Options", "SAMEORIGIN");
    c.header("Referrer-Policy", "strict-origin-when-cross-origin");
    c.header("Cache-Control", "no-store");
    if (/^\/(css|js|images)\//.test(c.req.path))
        return c.env.ASSETS.fetch(c.req.raw);
    const sql = postgres(c.env.HYPERDRIVE.connectionString, {
        max: 5,
        prepare: false,
        fetch_types: false,
        connect_timeout: 10,
        idle_timeout: 5,
        max_lifetime: 60,
    });
    c.set("sql", sql);
    try {
        let session;
        const cookie = getCookie(c, "cotech_session");
        if (cookie && /^[a-f0-9]{64}$/.test(cookie)) {
            [session] =
                await sql`SELECT s.*,u.name,u.email,u.role FROM cotech.worker_sessions s LEFT JOIN cotech.users u ON u.id=s.user_id WHERE s.id=${await digest(cookie)} AND s.expires_at>now()`;
            if (session?.user_id)
                c.set("user", {
                    id: session.user_id,
                    name: session.name,
                    email: session.email,
                    role: session.role,
                });
        }
        c.set("session", session);
        c.set(
            "company",
            Object.fromEntries(
                (await sql`SELECT key,value FROM cotech.settings`).map((s) => [
                    s.key,
                    s.value,
                ]),
            ),
        );
        if (c.req.path.startsWith("/admin") && !c.get("user"))
            return c.redirect("/login");
        const hasAttribution = ["utm_source", "utm_medium", "utm_campaign", "utm_content", "utm_term"].some(key => c.req.query(key));
        if (
            (["GET", "HEAD"].includes(c.req.method) &&
                ["/login", "/orcamento", "/forgot-password"].includes(
                    c.req.path,
                )) ||
            (c.req.method === "GET" &&
                (c.req.path.startsWith("/reset-password/") || hasAttribution))
        ) {
            if (!session) session = await newSession(c);
            if (c.req.path === "/orcamento" || hasAttribution) {
                const attribution = { ...session.data };
                for (const key of [
                    "utm_source",
                    "utm_medium",
                    "utm_campaign",
                    "utm_content",
                    "utm_term",
                ]) {
                    const value = c.req.query(key);
                    if (value) attribution[key] = value.slice(0, 200);
                }
                if (!attribution.landing_page)
                    attribution.landing_page = new URL(c.req.url).pathname;
                if (
                    JSON.stringify(attribution) !== JSON.stringify(session.data)
                ) {
                    await sql`UPDATE cotech.worker_sessions SET data=${sql.json(attribution)} WHERE id=${session.id}`;
                    session.data = attribution;
                }
            }
        }
        if (!["GET", "HEAD"].includes(c.req.method)) {
            if (!/^(multipart\/form-data|application\/x-www-form-urlencoded)(;|$)/i.test(c.req.header("content-type") || "")) fail(415, "Formato de formulário inválido.");
            const origin = c.req.header("origin");
            if (origin !== new URL(c.req.url).origin)
                fail(403, "Origem da solicitação inválida.");
            if (!session) fail(419, "Sua sessão expirou. Recarregue a página.");
            if (Number(c.req.header("content-length") || 0) > 27 * 1024 * 1024)
                fail(413, "Os anexos excedem o limite permitido.");
            const reader = c.req.raw.body?.getReader();
            let total = 0;
            const chunks = [];
            if (reader)
                while (true) {
                    const { done, value } = await reader.read();
                    if (done) break;
                    total += value.length;
                    if (total > 27 * 1024 * 1024) {
                        await reader.cancel();
                        fail(413, "Os anexos excedem o limite permitido.");
                    }
                    chunks.push(value);
                }
            const fd = await new Response(new Blob(chunks), {
                headers: { "Content-Type": c.req.header("content-type") || "" },
            }).formData();
            if (fd.get("_token") !== session.csrf)
                fail(419, "Sua sessão expirou. Recarregue a página.");
            c.set("form", fd);
            c.set("body", Object.fromEntries(fd));
            c.set("method", fd.get("_method") || c.req.method);
        }
        await next();
    } finally {
        c.executionCtx.waitUntil(sql.end({ timeout: 5 }));
    }
});
app.onError((error, c) => {
    const status =
        error instanceof HttpError
            ? error.status
            : error.code === "23505"
              ? 422
              : 500;
    const message =
        status === 500
            ? "Não foi possível concluir a solicitação. Tente novamente."
            : error.code === "23505"
              ? "Este registro já existe. Confira os dados."
              : error.message;
    if (status === 500)
        console.error("Request failed", {
            path: c.req.path,
            code: error.code || error.name,
        });
    return c.html(
        layout(
            c,
            "Não foi possível continuar",
            pageHead(message) +
                `<section class="section"><div class="container"><a class="button" href="${c.get("user") ? "/admin" : "/"}">Voltar ao início</a></div></section>`,
        ),
        status,
    );
});
app.get("/", async (c) =>
    c.html(
        home(
            c,
            await db(
                c,
            )`SELECT * FROM cotech.contents WHERE ${published(db(c))} ORDER BY sort,id`,
        ),
    ),
);
for (const [path, type] of [
    ["/servicos", "service"],
    ["/blog", "post"],
])
    app.get(path, async (c) => {
        const sql = db(c),
            items =
                await sql`SELECT * FROM cotech.contents WHERE type=${type} AND ${published(sql)} ORDER BY sort,id LIMIT 12 OFFSET ${(page(c) - 1) * 12}`;
        return c.html(
            layout(
                c,
                type === "service" ? "Serviços" : "Conteúdos",
                pageHead(
                    type === "service"
                        ? "Seu desafio. Nossa próxima missão."
                        : "Ideias que abrem caminhos.",
                ) +
                    `<section class="section"><div class="container"><div class="${type === "service" ? "solution-grid" : "insight-grid"}">${items.length ? (type === "service" ? serviceCards(items) : postCards(items)) : "<p>Nenhum conteúdo publicado.</p>"}</div>${pager(c, items.length, 12)}</div></section>`,
            ),
        );
    });
for (const [path, type] of [
    ["/servicos/:slug", "service"],
    ["/blog/:slug", "post"],
    ["/pagina/:slug", "page"],
])
    app.get(path, async (c) => {
        const sql = db(c),
            [item] =
                await sql`SELECT * FROM cotech.contents WHERE type=${type} AND slug=${c.req.param("slug")} AND ${published(sql)}`;
        requireRow(item);
        return c.html(
            layout(
                c,
                item.seo_title || item.title,
                pageHead(item.title, item.summary) +
                    `<section class="section"><div class="container detail-layout"><article>${item.image ? `<img class="detail-image" src="${esc(item.image)}" alt="${esc(item.title)}">` : ""}<div class="prose">${esc(item.body)}</div>${type === "service" ? `<div class="actions"><a class="button" href="/orcamento?service=${item.id}">Quero uma proposta ↗</a></div>` : ""}</article><aside class="detail-aside"><h3>Seu negócio merece uma boa conversa.</h3><a href="/orcamento">Fale com nossa equipe ↗</a></aside></div></section>`,
                false,
                item.meta_description || item.summary,
            ),
        );
    });
app.get("/sitemap.xml", async (c) => {
    const sql = db(c),
        rows =
            await sql`SELECT type,slug FROM cotech.contents WHERE type IN ('service','post','page') AND ${published(sql)}`;
    const paths = [
        "/",
        "/servicos",
        "/blog",
        "/orcamento",
        ...rows.map(
            (x) =>
                ({ service: "/servicos/", post: "/blog/", page: "/pagina/" })[
                    x.type
                ] + x.slug,
        ),
    ];
    c.header("Content-Type", "application/xml");
    return c.body(
        `<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">${paths.map((path) => `<url><loc>${esc(new URL(path, c.req.url).href)}</loc></url>`).join("")}</urlset>`,
    );
});
app.get("/robots.txt", (c) =>
    c.text(
        `User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /login\nSitemap: ${new URL("/sitemap.xml", c.req.url).href}\n`,
    ),
);
app.get("/orcamento", async (c) => {
    const sql = db(c);
    return c.html(
        quote(
            c,
            await sql`SELECT id,title FROM cotech.contents WHERE type='service' AND ${published(sql)} ORDER BY sort,id`,
        ),
    );
});
app.post("/orcamento", async (c) => {
    const sql = db(c),
        data = body(c);
    await rateLimit(sql, "quote:" + c.req.header("cf-connecting-ip"));
    const lead = {
        name: text(data, "name", { required: true, max: 150 }),
        phone: text(data, "phone", { required: true, min: 8, max: 30 }),
        email: email(data),
        company: text(data, "company"),
        document: text(data, "document", { max: 30 }),
        city: text(data, "city", { max: 150 }),
        message: text(data, "message", { required: true, min: 10, max: 5000 }),
        priority: choice(data, "priority", Object.keys(priorities), "normal"),
        contact_preference: choice(
            data,
            "contact_preference",
            ["whatsapp", "email", "phone"],
            "whatsapp",
        ),
        service_id: integer(data, "service_id", { optional: true }),
    };
    if (
        data.consent !== "1" ||
        text(data, "website") ||
        (lead.contact_preference === "email" && !lead.email)
    )
        fail(
            422,
            "Confirme o consentimento, o e-mail e os campos obrigatórios.",
        );
    if (
        lead.service_id &&
        !(
            await sql`SELECT id FROM cotech.contents WHERE id=${lead.service_id} AND type='service' AND ${published(sql)}`
        ).length
    )
        fail(422, "O serviço selecionado não está disponível.");
    const attachments = [
        ...c.get("form").getAll("attachments"),
        ...c.get("form").getAll("attachments[]"),
    ].filter((x) => typeof x !== "string" && x.size);
    if (attachments.length > 5) fail(422, "Envie no máximo cinco arquivos.");
    const files = [];
    for (const file of attachments) files.push(await checkFile(file));
    const attribution = {
        ...c.get("session").data,
        conversion_page: (c.req.header("referer") || "").slice(0, 1000),
    };
    await sql.begin(async (tx) => {
        const [stage] =
            await tx`SELECT id FROM cotech.lead_statuses ORDER BY sort,id LIMIT 1`;
        const [saved] =
            await tx`INSERT INTO cotech.leads ${tx({ ...lead, status_id: stage.id, consent_version: "2026-09-v1", consented_at: new Date(), attribution: tx.json(attribution), source: attribution.utm_source || "site", created_at: new Date(), updated_at: new Date() })} RETURNING id`;
        for (const entry of files) {
            const fileId = crypto.randomUUID();
            const [media] =
                await tx`INSERT INTO cotech.media(lead_id,path,name,mime,created_at,updated_at) VALUES (${saved.id},${fileId},${entry.name},${entry.mime},now(),now()) RETURNING id`;
            await tx`INSERT INTO cotech.worker_files(id,media_id,name,mime,data) VALUES (${fileId},${media.id},${entry.name},${entry.mime},${Buffer.from(await entry.file.arrayBuffer())})`;
        }
        await tx`INSERT INTO cotech.lead_interactions(lead_id,message,created_at,updated_at) VALUES (${saved.id},'Solicitação recebida pelo site.',now(),now())`;
        await audit(tx, c, "created", "lead", saved.id);
        await mail(
            tx,
            c.get("company").email,
            "Novo orçamento Cotech #" + saved.id,
            "Uma nova solicitação está disponível no painel: " +
                new URL("/admin/leads/" + saved.id, c.req.url).href,
        );
    });
    return redirect(c, "/orcamento", "sent");
});
app.get("/login", (c) =>
    c.get("user")
        ? c.redirect("/admin")
        : c.html(
              layout(
                  c,
                  "Entrar",
                  pageHead("Área da equipe") +
                      `<section class="section"><div class="container" style="max-width:560px">${form(c, "/login", `${input("email", "E-mail", "", "email", 'required autocomplete="username"')}${input("password", "Senha", "", "password", 'required autocomplete="current-password"')}<button>Entrar</button><p><a href="/forgot-password">Esqueci minha senha</a></p>`, "POST", 'class="card"')}</div></section>`,
              ),
          ),
);
app.post("/login", async (c) => {
    const sql = db(c),
        data = body(c),
        address = email(data, "email", true),
        password = text(data, "password", { required: true, max: 1000 });
    await rateLimit(sql, "login-ip:" + c.req.header("cf-connecting-ip"));
    await rateLimit(sql, "login-email:" + address);
    const [user] =
        await sql`SELECT * FROM cotech.users WHERE lower(email)=${address}`;
    const valid = await passwordMatches(
        password,
        user?.password ||
            "pbkdf2$100000$" + "0".repeat(64) + "$" + "0".repeat(64),
    );
    if (!valid) fail(422, "E-mail ou senha incorretos.");
    await sql`DELETE FROM cotech.worker_sessions WHERE id=${c.get("session").id}`;
    await newSession(c, user.id);
    c.set("user", user);
    await audit(sql, c, "login", "user", user.id);
    return c.redirect("/admin", 303);
});
app.post("/logout", async (c) => {
    await db(
        c,
    )`DELETE FROM cotech.worker_sessions WHERE id=${c.get("session").id}`;
    setCookie(c, "cotech_session", "", { ...cookieOptions(c), maxAge: 0 });
    return c.redirect("/", 303);
});
app.get("/forgot-password", (c) =>
    c.html(
        layout(
            c,
            "Recuperar senha",
            pageHead("Recuperar acesso") +
                `<section class="section"><div class="container" style="max-width:560px">${form(c, "/forgot-password", `${input("email", "E-mail", "", "email", "required")}<button>Enviar instruções</button>`, "POST", 'class="card"')}</div></section>`,
        ),
    ),
);
app.post("/forgot-password", async (c) => {
    const sql = db(c);
    await rateLimit(sql, "reset:" + c.req.header("cf-connecting-ip"), 3);
    if (!c.env.MAILER)
        fail(
            503,
            "A recuperação por e-mail ainda não está configurada. Entre em contato com o administrador.",
        );
    const address = email(body(c), "email", true),
        [user] =
            await sql`SELECT id FROM cotech.users WHERE lower(email)=${address}`;
    if (user) {
        const token = random();
        await sql.begin(async (tx) => {
            await tx`DELETE FROM cotech.worker_reset_tokens WHERE user_id=${user.id}`;
            await tx`INSERT INTO cotech.worker_reset_tokens(token,user_id,expires_at) VALUES (${await digest(token)},${user.id},now()+interval '1 hour')`;
            await mail(
                tx,
                address,
                "Recuperar acesso Cotech",
                new URL("/reset-password/" + token, c.req.url).href,
            );
        });
    }
    return redirect(c, "/forgot-password", "requested");
});
app.get("/reset-password/:token", (c) =>
    c.html(
        layout(
            c,
            "Nova senha",
            pageHead("Definir nova senha") +
                `<section class="section"><div class="container" style="max-width:560px">${form(c, "/reset-password", `<input type="hidden" name="token" value="${esc(c.req.param("token"))}">${input("password", "Nova senha", "", "password", 'required minlength="12" autocomplete="new-password"')}${input("password_confirmation", "Confirme a senha", "", "password", 'required minlength="12"')}<button>Atualizar senha</button>`, "POST", 'class="card"')}</div></section>`,
        ),
    ),
);
app.post("/reset-password", async (c) => {
    const sql = db(c),
        data = body(c);
    await rateLimit(sql, "reset-submit:" + c.req.header("cf-connecting-ip"));
    const password = text(data, "password", {
        required: true,
        min: 12,
        max: 1000,
    });
    if (password !== data.password_confirmation)
        fail(422, "As senhas não coincidem.");
    const token = await digest(
        text(data, "token", { required: true, max: 100 }),
    );
    await sql.begin(async (tx) => {
        const [row] =
            await tx`DELETE FROM cotech.worker_reset_tokens WHERE token=${token} AND expires_at>now() RETURNING user_id`;
        if (!row) fail(422, "Link inválido ou expirado.");
        await tx`UPDATE cotech.users SET password=${await passwordHash(password)},updated_at=now() WHERE id=${row.user_id}`;
        await tx`DELETE FROM cotech.worker_sessions WHERE user_id=${row.user_id}`;
    });
    return redirect(c, "/login", "reset");
});
app.get("/admin", async (c) => {
    if (c.get("user").role === "editor") return c.redirect("/admin/conteudos");
    authorize(c, "commercial");
    const sql = db(c);
    const from =
            c.req.query("from") ||
            new Date(Date.now() - 29 * 86400000).toISOString().slice(0, 10),
        to = c.req.query("to") || new Date().toISOString().slice(0, 10);
    if (
        !/^\d{4}-\d\d-\d\d$/.test(from) ||
        !/^\d{4}-\d\d-\d\d$/.test(to) ||
        !Number.isFinite(Date.parse(from)) ||
        !Number.isFinite(Date.parse(to)) ||
        from > to
    )
        fail(422, "Período inválido.");
    const [stats] =
        await sql`SELECT count(*)::int total,count(*) FILTER(WHERE s.outcome='won')::int won,count(*) FILTER(WHERE s.outcome='lost')::int lost FROM cotech.leads l JOIN cotech.lead_statuses s ON s.id=l.status_id WHERE l.created_at>=${from}::date AND l.created_at<${to}::date+interval '1 day'`;
    const [customers] =
        await sql`SELECT count(*)::int count FROM cotech.customers`;
    const stages =
        await sql`SELECT s.name,count(l.id)::int count FROM cotech.lead_statuses s LEFT JOIN cotech.leads l ON l.status_id=s.id AND l.created_at>=${from}::date AND l.created_at<${to}::date+interval '1 day' GROUP BY s.id ORDER BY s.sort`;
    const sources =
        await sql`SELECT source,count(*)::int count FROM cotech.leads WHERE created_at>=${from}::date AND created_at<${to}::date+interval '1 day' GROUP BY source`;
    const recent =
        await sql`SELECT l.*,s.name stage_name FROM cotech.leads l JOIN cotech.lead_statuses s ON s.id=l.status_id WHERE l.created_at>=${from}::date AND l.created_at<${to}::date+interval '1 day' ORDER BY l.created_at DESC LIMIT 8`;
    return c.html(
        layout(
            c,
            "Visão geral",
            `<h1>Visão geral</h1><form class="filters">${input("from", "De", from, "date")}${input("to", "Até", to, "date")}<button>Aplicar período</button></form><div class="stats">${[
                [stats.total, "Leads no período"],
                [stats.won, "Negócios ganhos"],
                [stats.lost, "Negócios perdidos"],
                [customers.count, "Clientes cadastrados"],
            ]
                .map(
                    ([value, label]) =>
                        `<div class="card stat"><span>${label}</span><strong>${value}</strong></div>`,
                )
                .join(
                    "",
                )}</div><div class="grid two"><section class="card"><h3>Funil comercial</h3>${table(
                ["Etapa", "Leads"],
                stages.map((s) => [esc(s.name), s.count]),
            )}</section><section class="card"><h3>Origem dos contatos</h3>${table(
                ["Origem", "Leads"],
                sources.map((s) => [esc(s.source), s.count]),
            )}</section></div><h2>Solicitações recentes</h2>${leadTable(recent)}`,
            true,
        ),
    );
});
app.get("/admin/leads", async (c) => {
    authorize(c, "commercial");
    const sql = db(c),
        q = (c.req.query("q") || "").slice(0, 190),
        status = c.req.query("status")
            ? integer({ status: c.req.query("status") }, "status")
            : null;
    const rows =
        await sql`SELECT l.*,s.name stage_name FROM cotech.leads l JOIN cotech.lead_statuses s ON s.id=l.status_id WHERE (${q}='' OR l.name ILIKE ${"%" + q + "%"} OR l.company ILIKE ${"%" + q + "%"}) AND (${status}::bigint IS NULL OR l.status_id=${status}) ORDER BY l.created_at DESC LIMIT 25 OFFSET ${(page(c) - 1) * 25}`;
    const stages = await sql`SELECT * FROM cotech.lead_statuses ORDER BY sort`;
    return c.html(
        layout(
            c,
            "Leads",
            `<div class="row"><h1>Leads</h1><a href="/admin/kanban">Ver funil comercial ↗</a></div><form class="filters">${input("q", "Buscar nome ou empresa", q)}${select("status", "Etapa", { "": "Todas", ...options(stages) }, status)}<button>Filtrar</button></form>${leadTable(rows)}${pager(c, rows.length)}`,
            true,
        ),
    );
});
app.get("/admin/kanban", async (c) => {
    authorize(c, "commercial");
    const sql = db(c),
        stages = await sql`SELECT * FROM cotech.lead_statuses ORDER BY sort`,
        leads =
            await sql`SELECT * FROM cotech.leads ORDER BY created_at DESC LIMIT 500`;
    return c.html(
        layout(
            c,
            "Funil comercial",
            `<h1>Funil comercial</h1><p>Até 500 contatos recentes. Use a lista de leads para consultar todo o histórico.</p><div class="grid">${stages
                .map(
                    (s) =>
                        `<section class="card"><h2>${esc(s.name)}</h2>${leads
                            .filter((l) => l.status_id === s.id)
                            .map(
                                (l) =>
                                    `<p><a class="text-link" href="/admin/leads/${l.id}">${esc(l.name)}</a><br>${esc(l.company)}</p>`,
                            )
                            .join("")}</section>`,
                )
                .join("")}</div>`,
            true,
        ),
    );
});
app.get("/admin/leads/:id", async (c) => {
    authorize(c, "commercial");
    const sql = db(c),
        [lead] =
            await sql`SELECT l.*,s.name stage_name,ct.title service_title FROM cotech.leads l JOIN cotech.lead_statuses s ON s.id=l.status_id LEFT JOIN cotech.contents ct ON ct.id=l.service_id WHERE l.id=${id(c)}`;
    requireRow(lead);
    const stages = await sql`SELECT * FROM cotech.lead_statuses ORDER BY sort`,
        users =
            await sql`SELECT id,name FROM cotech.users WHERE role IN ('admin','attendant')`,
        media =
            await sql`SELECT id,name FROM cotech.media WHERE lead_id=${lead.id}`,
        notes =
            await sql`SELECT i.*,u.name user_name FROM cotech.lead_interactions i LEFT JOIN cotech.users u ON u.id=i.user_id WHERE lead_id=${lead.id} ORDER BY i.created_at DESC`;
    return c.html(
        layout(
            c,
            "Detalhes do lead",
            `<a href="/admin/leads">← Todos os leads</a><h1>${esc(lead.name)}</h1><div class="split"><div class="stack"><section class="card"><h3>${esc(lead.service_title || "Orientação geral")}</h3><p class="prose">${esc(lead.message)}</p>${table(
                ["Campo", "Informação"],
                [
                    "phone",
                    "email",
                    "company",
                    "document",
                    "city",
                    "contact_preference",
                    "source",
                ].map((k) => [esc(k), esc(lead[k])]),
            )}<h3>Anexos</h3>${media.map((m) => `<p><a href="/admin/media/${m.id}">↓ ${esc(m.name)}</a></p>`).join("")}<p>Consentimento registrado em ${esc(stamp(lead.consented_at))}.</p></section><section class="card"><h3>Histórico de atendimento</h3>${form(c, `/admin/leads/${lead.id}/interactions`, textarea("message", "Nova anotação", "", 'required maxlength="5000"') + "<button>Registrar interação</button>")}${notes.map((n) => `<div class="timeline"><span>${esc(n.user_name || "Sistema")} · ${esc(stamp(n.created_at))}</span><p>${esc(n.message)}</p></div>`).join("")}</section></div><aside class="stack">${form(c, `/admin/leads/${lead.id}`, `<h3>Acompanhamento</h3>${select("status_id", "Etapa", options(stages), lead.status_id)}${select("priority", "Prioridade", priorities, lead.priority)}${select("assigned_to", "Responsável", { "": "Não atribuído", ...options(users) }, lead.assigned_to)}<button>Salvar alterações</button>`, "PATCH", 'class="card"')}<section class="card">${lead.customer_id ? '<h3>Cliente vinculado</h3><a href="/admin/solicitacoes">Ver solicitações</a>' : form(c, `/admin/leads/${lead.id}/convert`, "<h3>Pronto para avançar?</h3><button>Converter em cliente</button>")}</section>${c.get("user").role === "admin" ? form(c, `/admin/leads/${lead.id}`, '<button class="danger">Excluir lead</button>', "DELETE", 'data-confirm="Excluir definitivamente este lead, seu histórico e seus anexos?"') : ""}</aside></div>`,
            true,
        ),
    );
});
app.post("/admin/leads/:id", async (c) => {
    const sql = db(c),
        leadId = id(c);
    if (c.get("method") === "DELETE") {
        authorize(c, "administration");
        await sql.begin(async (tx) => {
            const rows =
                await tx`DELETE FROM cotech.leads WHERE id=${leadId} RETURNING id`;
            requireRow(rows[0]);
            await audit(tx, c, "deleted", "lead", leadId);
        });
        return redirect(c, "/admin/leads", "deleted");
    }
    authorize(c, "commercial");
    const data = body(c),
        status = integer(data, "status_id"),
        assigned = integer(data, "assigned_to", { optional: true }),
        priority = choice(data, "priority", Object.keys(priorities));
    if (
        !(await sql`SELECT id FROM cotech.lead_statuses WHERE id=${status}`)
            .length
    )
        fail(422, "Etapa inválida.");
    if (
        assigned &&
        !(
            await sql`SELECT id FROM cotech.users WHERE id=${assigned} AND role IN ('admin','attendant')`
        ).length
    )
        fail(422, "Responsável inválido.");
    await sql.begin(async (tx) => {
        const [lead] =
            await tx`UPDATE cotech.leads SET status_id=${status},assigned_to=${assigned},priority=${priority},last_interaction_at=now(),updated_at=now() WHERE id=${leadId} RETURNING id`;
        requireRow(lead);
        await tx`INSERT INTO cotech.lead_interactions(lead_id,user_id,message,created_at,updated_at) VALUES (${leadId},${c.get("user").id},'Etapa, responsável ou prioridade atualizados.',now(),now())`;
        await audit(tx, c, "updated", "lead", leadId);
    });
    return redirect(c, "/admin/leads/" + leadId);
});
app.post("/admin/leads/:id/interactions", async (c) => {
    authorize(c, "commercial");
    const sql = db(c),
        leadId = id(c),
        message = text(body(c), "message", { required: true, max: 5000 });
    requireRow((await sql`SELECT id FROM cotech.leads WHERE id=${leadId}`)[0]);
    await sql.begin(async (tx) => {
        await tx`INSERT INTO cotech.lead_interactions(lead_id,user_id,message,created_at,updated_at) VALUES (${leadId},${c.get("user").id},${message},now(),now())`;
        await tx`UPDATE cotech.leads SET last_interaction_at=now(),updated_at=now() WHERE id=${leadId}`;
        await audit(tx, c, "interaction", "lead", leadId);
    });
    return redirect(c, "/admin/leads/" + leadId);
});
app.post("/admin/leads/:id/convert", async (c) => {
    authorize(c, "commercial");
    const sql = db(c),
        leadId = id(c),
        customerId = integer(body(c), "customer_id", { optional: true });
    await sql.begin(async (tx) => {
        const [lead] =
            await tx`SELECT * FROM cotech.leads WHERE id=${leadId} FOR UPDATE`;
        requireRow(lead);
        if (lead.customer_id) return;
        let customer;
        if (customerId) {
            [customer] =
                await tx`SELECT id FROM cotech.customers WHERE id=${customerId}`;
            requireRow(customer);
        } else {
            [customer] = lead.email
                ? await tx`SELECT id FROM cotech.customers WHERE email=${lead.email} LIMIT 1`
                : await tx`SELECT id FROM cotech.customers WHERE phone=${lead.phone} LIMIT 1`;
            if (!customer)
                [customer] =
                    await tx`INSERT INTO cotech.customers ${tx({ name: lead.name, phone: lead.phone, email: lead.email, company: lead.company, document: lead.document, city: lead.city, created_at: new Date(), updated_at: new Date() })} RETURNING id`;
        }
        const [won] =
            await tx`SELECT id FROM cotech.lead_statuses WHERE outcome='won' ORDER BY sort LIMIT 1`;
        await tx`UPDATE cotech.leads SET customer_id=${customer.id},status_id=${won.id},updated_at=now() WHERE id=${leadId}`;
        await tx`INSERT INTO cotech.service_requests(lead_id,customer_id,service_id,description,priority,created_at,updated_at) VALUES (${leadId},${customer.id},${lead.service_id},${lead.message},${lead.priority},now(),now())`;
        await tx`INSERT INTO cotech.lead_interactions(lead_id,user_id,message,created_at,updated_at) VALUES (${leadId},${c.get("user").id},'Convertido em cliente. Solicitação de serviço criada.',now(),now())`;
        await audit(tx, c, "converted", "lead", leadId);
    });
    return redirect(c, "/admin/leads/" + leadId, "converted");
});
app.get("/admin/media/:id", async (c) => {
    authorize(c, "commercial");
    const [file] = await db(
        c,
    )`SELECT f.* FROM cotech.worker_files f JOIN cotech.media m ON m.id=f.media_id WHERE m.id=${id(c)}`;
    requireRow(file);
    return new Response(file.data, {
        headers: {
            "Content-Type": file.mime,
            "Content-Disposition": `attachment; filename*=UTF-8''${encodeURIComponent(file.name)}`,
            "Cache-Control": "private, no-store",
            "X-Content-Type-Options": "nosniff",
        },
    });
});
app.get("/storage/content/:file", async (c) => {
    const uuid = c.req.param("file");
    if (!/^[a-f\d-]{36}$/.test(uuid)) fail(404, "Imagem não encontrada.");
    const sql = db(c),
        [file] =
            await sql`SELECT f.mime,f.data FROM cotech.worker_files f WHERE f.id=${uuid}::uuid AND EXISTS (SELECT 1 FROM cotech.contents WHERE id=f.content_id AND ${published(sql)})`;
    requireRow(file);
    return new Response(file.data, {
        headers: {
            "Content-Type": file.mime,
            "Cache-Control": "public, max-age=60",
            "X-Content-Type-Options": "nosniff",
        },
    });
});
app.get("/admin/clientes", async (c) => {
    authorize(c, "commercial");
    const sql = db(c),
        q = (c.req.query("q") || "").slice(0, 190),
        rows =
            await sql`SELECT * FROM cotech.customers WHERE ${q}='' OR name ILIKE ${"%" + q + "%"} ORDER BY created_at DESC LIMIT 25 OFFSET ${(page(c) - 1) * 25}`;
    return c.html(
        layout(
            c,
            "Clientes",
            `<h1>Clientes</h1><form class="filters">${input("q", "Buscar cliente", q)}<button>Buscar</button></form>${table(
                ["Nome", "Telefone", "E-mail", "Empresa"],
                rows.map((r) => [
                    esc(r.name),
                    esc(r.phone),
                    esc(r.email),
                    esc(r.company),
                ]),
            )}${pager(c, rows.length)}<details class="card"><summary>Cadastrar cliente</summary>${form(c, "/admin/clientes", `<div class="form-grid">${input("name", "Nome", "", "text", 'required maxlength="150"')}${input("phone", "Telefone", "", "tel", 'required maxlength="30"')}${input("email", "E-mail", "", "email")}${input("company", "Empresa")}${input("document", "Documento")}${input("city", "Cidade")}${select("type", "Tipo", { individual: "Pessoa física", company: "Empresa" })}${textarea("address", "Endereço")}${textarea("notes", "Observações")}</div><button>Cadastrar cliente</button>`)}</details>`,
            true,
        ),
    );
});
app.post("/admin/clientes", async (c) => {
    authorize(c, "commercial");
    const sql = db(c),
        data = body(c),
        customer = {
            name: text(data, "name", { required: true, max: 150 }),
            phone: text(data, "phone", { required: true, max: 30 }),
            email: email(data),
            company: text(data, "company"),
            document: text(data, "document", { max: 30 }),
            city: text(data, "city", { max: 150 }),
            type: choice(data, "type", ["individual", "company"], "individual"),
            address: text(data, "address", { max: 1000 }),
            notes: text(data, "notes", { max: 5000 }),
            created_at: new Date(),
            updated_at: new Date(),
        };
    await sql.begin(async (tx) => {
        const [row] =
            await tx`INSERT INTO cotech.customers ${tx(customer)} RETURNING id`;
        await audit(tx, c, "created", "customer", row.id);
    });
    return redirect(c, "/admin/clientes", "created");
});
app.get("/admin/solicitacoes", async (c) => {
    authorize(c, "commercial");
    const rows = await db(
        c,
    )`SELECT r.*,cu.name FROM cotech.service_requests r JOIN cotech.customers cu ON cu.id=r.customer_id ORDER BY r.created_at DESC LIMIT 25 OFFSET ${(page(c) - 1) * 25}`;
    return c.html(
        layout(
            c,
            "Solicitações",
            `<h1>Solicitações</h1>${table(
                ["Cliente", "Descrição", "Prioridade", "Andamento"],
                rows.map((r) => [
                    esc(r.name),
                    esc(r.description),
                    esc(priorities[r.priority]),
                    form(
                        c,
                        "/admin/solicitacoes/" + r.id,
                        select(
                            "status",
                            "Situação",
                            Object.fromEntries(
                                [
                                    "Aberta",
                                    "Em atendimento",
                                    "Concluída",
                                    "Cancelada",
                                ].map((s) => [s, s]),
                            ),
                            r.status,
                        ) + "<button>Salvar</button>",
                        "PATCH",
                    ),
                ]),
            )}${pager(c, rows.length)}`,
            true,
        ),
    );
});
app.post("/admin/solicitacoes/:id", async (c) => {
    authorize(c, "commercial");
    const sql = db(c),
        status = choice(body(c), "status", [
            "Aberta",
            "Em atendimento",
            "Concluída",
            "Cancelada",
        ]);
    await sql.begin(async (tx) => {
        requireRow(
            (
                await tx`UPDATE cotech.service_requests SET status=${status},updated_at=now() WHERE id=${id(c)} RETURNING id`
            )[0],
        );
        await audit(tx, c, "updated", "service_request", id(c));
    });
    return redirect(c, "/admin/solicitacoes");
});
app.get("/admin/conteudos", async (c) => {
    authorize(c, "content");
    const type = c.req.query("type") || "service";
    if (!types[type]) fail(404, "Tipo inválido.");
    const rows = await db(
        c,
    )`SELECT * FROM cotech.contents WHERE type=${type} ORDER BY sort,created_at DESC LIMIT 25 OFFSET ${(page(c) - 1) * 25}`;
    return c.html(
        layout(
            c,
            "Conteúdos",
            `<h1>Conteúdos</h1><div class="tabs">${Object.entries(types)
                .map(
                    ([key, label]) =>
                        `<a href="/admin/conteudos?type=${key}">${label}</a>`,
                )
                .join(
                    "",
                )}</div><p><a class="button" href="/admin/conteudos/novo?type=${type}">Adicionar conteúdo</a></p>${table(
                ["Título", "Estado", "Ações"],
                rows.map((r) => [
                    esc(r.title),
                    r.active ? "Publicado / agendado" : "Rascunho",
                    `<a href="/admin/conteudos/${r.id}/editar">Editar</a> ${form(c, "/admin/conteudos/" + r.id, '<button class="danger">Excluir</button>', "DELETE", 'data-confirm="Excluir este conteúdo?"')} `,
                ]),
            )}${pager(c, rows.length)}`,
            true,
        ),
    );
});
app.get("/admin/conteudos/novo", (c) => {
    authorize(c, "content");
    const type = c.req.query("type") || "service";
    if (!types[type]) fail(404, "Tipo inválido.");
    return c.html(contentForm(c, { type }));
});
app.get("/admin/conteudos/:id/editar", async (c) => {
    authorize(c, "content");
    return c.html(
        contentForm(
            c,
            requireRow(
                (
                    await db(c)`SELECT * FROM cotech.contents WHERE id=${id(c)}`
                )[0],
            ),
        ),
    );
});
async function saveContent(c) {
    authorize(c, "content");
    const sql = db(c),
        itemId = c.req.param("id") ? id(c) : null;
    if (c.get("method") === "DELETE") {
        await sql.begin(async (tx) => {
            requireRow(
                (
                    await tx`DELETE FROM cotech.contents WHERE id=${itemId} RETURNING id`
                )[0],
            );
            await audit(tx, c, "deleted", "content", itemId);
        });
        return redirect(c, "/admin/conteudos", "deleted");
    }
    const data = body(c),
        item = {
            type: choice(data, "type", Object.keys(types)),
            title: text(data, "title", { required: true, max: 190 }),
            slug: text(data, "slug", { required: true, max: 190 }),
            sort: integer(data, "sort", { min: 0, max: 9999 }),
            category: text(data, "category", { max: 100 }),
            summary: text(data, "summary", { max: 1000 }),
            body: text(data, "body", { max: 50000 }),
            seo_title: text(data, "seo_title"),
            meta_description: text(data, "meta_description", { max: 320 }),
            active: data.active === "1",
            authorized: data.authorized === "1",
            published_at: date(data, "published_at"),
            ends_at: date(data, "ends_at"),
            updated_at: new Date(),
        };
    if (!/^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(item.slug))
        fail(422, "Endereço inválido.");
    if (item.ends_at && item.published_at && item.ends_at <= item.published_at)
        fail(422, "A data de encerramento deve ser posterior à publicação.");
    if (item.type === "testimonial" && item.active && !item.authorized)
        fail(422, "Confirme a autorização para publicar o depoimento.");
    const image = await checkFile(c.get("form").get("image"), true);
    await sql.begin(async (tx) => {
        let saved;
        if (itemId) {
            [saved] =
                await tx`UPDATE cotech.contents SET ${tx(item)} WHERE id=${itemId} RETURNING id`;
            requireRow(saved);
        } else
            [saved] =
                await tx`INSERT INTO cotech.contents ${tx({ ...item, created_at: new Date() })} RETURNING id`;
        if (image) {
            const uuid = crypto.randomUUID();
            await tx`DELETE FROM cotech.worker_files WHERE content_id=${saved.id}`;
            await tx`INSERT INTO cotech.worker_files(id,content_id,name,mime,data) VALUES (${uuid},${saved.id},${image.name},${image.mime},${Buffer.from(await image.file.arrayBuffer())})`;
            await tx`UPDATE cotech.contents SET image=${"/storage/content/" + uuid} WHERE id=${saved.id}`;
        }
        await audit(tx, c, "saved", "content", saved.id);
    });
    return redirect(c, "/admin/conteudos?type=" + item.type);
}
app.post("/admin/conteudos", saveContent);
app.post("/admin/conteudos/:id", saveContent);
const settingsFields = {
    name: "Nome da empresa",
    email: "E-mail de atendimento",
    whatsapp: "WhatsApp com código do país",
    phone: "Telefone",
    address: "Endereço",
    hours: "Horário de atendimento",
    hero_title: "Título principal do site",
    hero_text: "Texto principal do site",
    footer: "Texto do rodapé",
};
app.get("/admin/configuracoes", async (c) => {
    authorize(c, "administration");
    const sql = db(c),
        users =
            await sql`SELECT id,name,email,role FROM cotech.users ORDER BY id`,
        stages = await sql`SELECT * FROM cotech.lead_statuses ORDER BY sort`,
        logs =
            await sql`SELECT * FROM cotech.audit_logs ORDER BY created_at DESC LIMIT 30`,
        [pending] =
            await sql`SELECT count(*)::int total FROM cotech.worker_mail WHERE sent_at IS NULL`;
    return c.html(
        layout(
            c,
            "Configurações",
            `<h1>Configurações</h1><div class="stack">${form(
                c,
                "/admin/configuracoes",
                '<h3>Empresa e site</h3><div class="form-grid">' +
                    Object.entries(settingsFields)
                        .map(([key, label]) =>
                            input(
                                key,
                                label,
                                c.get("company")[key],
                                key === "email" ? "email" : "text",
                                ["name", "hero_title", "hero_text"].includes(
                                    key,
                                )
                                    ? "required"
                                    : "",
                            ),
                        )
                        .join("") +
                    "</div><button>Salvar configurações</button>",
                "POST",
                'class="card"',
            )}<section class="card"><h3>Equipe e permissões</h3>${table(
                ["Nome", "E-mail", "Perfil", "Acesso"],
                users.map((u) => [
                    esc(u.name),
                    esc(u.email),
                    roles[u.role],
                    form(
                        c,
                        "/admin/usuarios/" + u.id + "/senha",
                        input(
                            "password",
                            "Nova senha",
                            "",
                            "password",
                            'required minlength="12" autocomplete="new-password"',
                        ) + "<button>Redefinir senha</button>",
                    ),
                ]),
            )}<details><summary>Adicionar usuário</summary>${form(c, "/admin/usuarios", `<div class="form-grid">${input("name", "Nome", "", "text", "required")}${input("email", "E-mail", "", "email", "required")}${input("password", "Senha inicial", "", "password", 'required minlength="12" autocomplete="new-password"')}${select("role", "Perfil", roles, "attendant")}</div><button>Criar usuário</button>`)}</details></section><section class="card"><h3>Etapas do funil</h3>${stages.map((s) => `<span class="badge">${s.sort} · ${esc(s.name)}</span>`).join(" ")}${form(c, "/admin/etapas", input("name", "Nova etapa", "", "text", 'required maxlength="60"') + input("sort", "Ordem", 25, "number", 'min="0" max="100" required') + input("color", "Cor", "#6366f1", "color") + "<button>Adicionar etapa</button>")}</section><section class="card"><h3>Notificações por e-mail</h3><p>${c.env.MAILER ? "Envio configurado." : "Envio ainda não configurado. Os orçamentos ficam disponíveis no painel."}</p><p>${pending.total} notificações aguardando envio.</p></section><section class="card"><h3>Atividade recente</h3>${table(
                ["Data", "Ação", "Registro", "Usuário"],
                logs.map((l) => [
                    esc(stamp(l.created_at)),
                    esc(l.action),
                    esc(l.entity) + " #" + esc(l.entity_id),
                    esc(l.user_id || "Visitante"),
                ]),
            )}</section></div>`,
            true,
        ),
    );
});
app.post("/admin/configuracoes", async (c) => {
    authorize(c, "administration");
    const data = body(c),
        settings = {};
    for (const key of Object.keys(settingsFields))
        settings[key] =
            key === "email"
                ? email(data)
                : text(data, key, {
                      required: ["name", "hero_title", "hero_text"].includes(
                          key,
                      ),
                      max:
                          {
                              name: 100,
                              whatsapp: 25,
                              phone: 30,
                              hours: 200,
                              hero_title: 150,
                          }[key] || 500,
                  });
    if (settings.whatsapp && !/^[0-9+ ()-]{8,25}$/.test(settings.whatsapp))
        fail(422, "WhatsApp inválido.");
    await db(c).begin(async (tx) => {
        for (const [key, value] of Object.entries(settings))
            await tx`INSERT INTO cotech.settings(key,value) VALUES (${key},${value}) ON CONFLICT(key) DO UPDATE SET value=excluded.value`;
        await audit(tx, c, "updated", "settings");
    });
    return redirect(c, "/admin/configuracoes");
});
app.post("/admin/usuarios", async (c) => {
    authorize(c, "administration");
    const sql = db(c),
        data = body(c),
        user = {
            name: text(data, "name", { required: true, max: 150 }),
            email: email(data, "email", true),
            password: await passwordHash(
                text(data, "password", { required: true, min: 12, max: 1000 }),
            ),
            role: choice(data, "role", Object.keys(roles)),
            created_at: new Date(),
            updated_at: new Date(),
        };
    await sql.begin(async (tx) => {
        const [row] =
            await tx`INSERT INTO cotech.users ${tx(user)} RETURNING id`;
        await audit(tx, c, "created", "user", row.id);
    });
    return redirect(c, "/admin/configuracoes", "created");
});
app.post("/admin/usuarios/:id/senha", async (c) => {
    authorize(c, "administration");
    const sql = db(c),
        hash = await passwordHash(
            text(body(c), "password", { required: true, min: 12, max: 1000 }),
        );
    await sql.begin(async (tx) => {
        requireRow(
            (
                await tx`UPDATE cotech.users SET password=${hash},updated_at=now() WHERE id=${id(c)} RETURNING id`
            )[0],
        );
        await tx`DELETE FROM cotech.worker_sessions WHERE user_id=${id(c)}`;
        await audit(tx, c, "password_reset", "user", id(c));
    });
    return redirect(c, "/admin/configuracoes");
});
app.post("/admin/etapas", async (c) => {
    authorize(c, "administration");
    const sql = db(c),
        data = body(c),
        name = text(data, "name", { required: true, max: 60 }),
        sort = integer(data, "sort", { min: 0, max: 100 }),
        color = text(data, "color", { required: true, max: 7 });
    if (!/^#[0-9a-fA-F]{6}$/.test(color)) fail(422, "Cor inválida.");
    await sql.begin(async (tx) => {
        const [row] =
            await tx`INSERT INTO cotech.lead_statuses(name,sort,color,created_at,updated_at) VALUES (${name},${sort},${color},now(),now()) RETURNING id`;
        await audit(tx, c, "created", "stage", row.id);
    });
    return redirect(c, "/admin/configuracoes", "created");
});
app.notFound((c) =>
    c.html(
        layout(
            c,
            "Página não encontrada",
            pageHead("Esta página não foi encontrada.") +
                '<section class="section"><div class="container"><a class="button" href="/">Voltar ao início</a></div></section>',
        ),
        404,
    ),
);
export default {
    fetch: app.fetch,
    async scheduled(event, env, ctx) {
        const sql = postgres(env.HYPERDRIVE.connectionString, {
            max: 1,
            prepare: false,
            fetch_types: false,
        });
        try {
            await sql`DELETE FROM cotech.worker_sessions WHERE expires_at<now()`;
            await sql`DELETE FROM cotech.worker_limits WHERE expires_at<now()`;
            await sql`DELETE FROM cotech.worker_reset_tokens WHERE expires_at<now()`;
            if (env.MAILER) {
                const pending =
                    await sql`SELECT * FROM cotech.worker_mail WHERE sent_at IS NULL AND attempts<5 ORDER BY id LIMIT 20`;
                for (const row of pending) {
                    await sql`UPDATE cotech.worker_mail SET attempts=attempts+1 WHERE id=${row.id}`;
                    try {
                        await env.MAILER.send({
                            from: env.MAIL_FROM,
                            to: row.recipient,
                            subject: row.subject,
                            text: row.body,
                        });
                        await sql`UPDATE cotech.worker_mail SET sent_at=now() WHERE id=${row.id}`;
                    } catch {
                        console.error("Mail delivery failed", { id: row.id });
                    }
                }
            }
        } finally {
            await sql.end({ timeout: 5 });
        }
    },
};

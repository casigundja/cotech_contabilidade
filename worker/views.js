import homeTemplate from "./home-template.js";
export const esc = (value) =>
    String(value ?? "").replace(
        /[&<>"']/g,
        (ch) =>
            ({
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
            })[ch],
    );
export const types = {
    service: "Serviços",
    category: "Categorias de serviços",
    post: "Artigos",
    post_category: "Categorias do blog",
    tag: "Tags",
    page: "Páginas",
    banner: "Banners",
    testimonial: "Depoimentos",
    team: "Equipe",
    certification: "Certificações",
    faq: "Perguntas frequentes",
    location: "Regiões atendidas",
};
export const roles = {
    admin: "Administrador",
    attendant: "Atendimento",
    editor: "Editor",
};
export const priorities = { normal: "Normal", high: "Alta", urgent: "Urgente" };
export const stamp = (value) =>
    value ? new Date(value).toLocaleString("pt-BR", { timeZone: "UTC" }) : "—";
export const csrf = (c) =>
    `<input type="hidden" name="_token" value="${esc(c.get("session")?.csrf)}">`;
export const input = (name, label, value = "", type = "text", extra = "") =>
    `<div class="field"><label for="${esc(name)}">${esc(label)}</label><input id="${esc(name)}" name="${esc(name)}" type="${type}" value="${esc(value)}" ${extra}></div>`;
export const textarea = (name, label, value = "", extra = "") =>
    `<div class="field full"><label for="${esc(name)}">${esc(label)}</label><textarea id="${esc(name)}" name="${esc(name)}" ${extra}>${esc(value)}</textarea></div>`;
export const select = (name, label, options, value = "", extra = "") =>
    `<div class="field"><label for="${esc(name)}">${esc(label)}</label><select id="${esc(name)}" name="${esc(name)}" ${extra}>${Object.entries(
        options,
    )
        .map(
            ([id, text]) =>
                `<option value="${esc(id)}" ${String(id) === String(value) ? "selected" : ""}>${esc(text)}</option>`,
        )
        .join("")}</select></div>`;
export const form = (c, action, body, method = "POST", extra = "") =>
    `<form method="post" action="${esc(action)}" ${extra}>${csrf(c)}${method !== "POST" ? `<input type="hidden" name="_method" value="${method}">` : ""}${body}</form>`;
export const table = (headers, rows) =>
    `<div class="table-wrap"><table><thead><tr>${headers.map((x) => `<th>${esc(x)}</th>`).join("")}</tr></thead><tbody>${rows.length ? rows.map((row) => `<tr>${row.map((cell) => `<td>${cell}</td>`).join("")}</tr>`).join("") : `<tr><td colspan="${headers.length}">Nenhum registro encontrado.</td></tr>`}</tbody></table></div>`;
export const options = (rows) =>
    Object.fromEntries(rows.map((row) => [row.id, row.name || row.title]));
const wa = (company) => {
    const number = (company.whatsapp || "").replace(/\D/g, "");
    return number
        ? `https://wa.me/${number}?text=${encodeURIComponent("Olá, gostaria de saber mais sobre os serviços da Cotech.")}`
        : "/orcamento";
};
export function layout(
    c,
    title,
    content,
    admin = false,
    description = "Contabilidade, consultoria e soluções para o crescimento do seu negócio.",
) {
    const company = c.get("company") || {},
        user = c.get("user"),
        path = c.req.path;
    const notices = {
        saved: "Alterações salvas.",
        sent: "Solicitação recebida! Nossa equipe entrará em contato.",
        created: "Registro criado.",
        deleted: "Registro excluído.",
        converted: "Cliente e solicitação vinculados.",
        reset: "Senha atualizada. Entre com sua nova senha.",
        requested:
            "Se o e-mail estiver cadastrado, você receberá as instruções de recuperação.",
    };
    const notice = notices[c.req.query("ok")];
    const head = `<!doctype html><html lang="pt"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="theme-color" content="#190864"><title>${esc(title)} | Cotech</title><meta name="description" content="${esc(description)}">${admin || /login|password/.test(path) ? '<meta name="robots" content="noindex,nofollow">' : ""}<link rel="icon" href="/images/logo.jpeg"><link rel="stylesheet" href="/css/site.css">${admin ? "" : '<link rel="stylesheet" href="/css/public.css?v=3">'}<script src="/js/site.js?v=3" defer></script></head>`;
    const feedback = notice
        ? `<div class="card" role="status">${esc(notice)}</div>`
        : "";
    if (admin) {
        const links = [];
        if (["admin", "attendant"].includes(user.role))
            links.push(
                ["/admin", "Visão geral"],
                ["/admin/leads", "Leads"],
                ["/admin/kanban", "Funil comercial"],
                ["/admin/clientes", "Clientes"],
                ["/admin/solicitacoes", "Solicitações"],
            );
        if (["admin", "editor"].includes(user.role))
            links.push(["/admin/conteudos", "Conteúdos"]);
        if (user.role === "admin")
            links.push(["/admin/configuracoes", "Configurações"]);
        return (
            head +
            `<body><a class="skip" href="#main">Ir para o conteúdo</a><div class="admin-shell"><aside class="sidebar"><a class="brand" href="/admin">COTECH.</a><nav aria-label="Painel">${links.map(([url, label]) => `<a href="${url}" class="${path === url ? "active" : ""}">${label}</a>`).join("")}<a href="/" target="_blank" rel="noopener">Ver site ↗</a></nav>${form(c, "/logout", '<button class="secondary">Sair da conta</button>', "POST", 'class="logout"')}</aside><main class="admin-main" id="main"><div class="admin-top row"><span>Área de gestão / ${esc(title)}</span><span>${esc(user.name)} · ${roles[user.role]}</span></div>${feedback}${content}</main></div></body></html>`
        );
    }
    return (
        head +
        `<body class="public-site"><a class="skip" href="#main">Ir para o conteúdo</a><div class="scroll-progress" aria-hidden="true"></div><div class="topbar"><div class="container"><span><i class="tiny-dot"></i> O futuro em suas mãos.</span><span>${esc(company.hours || "Conhecimento. Proximidade. Novas possibilidades.")}</span><a href="/login">Área da equipe ↗</a></div></div><header class="header"><div class="container header-inner"><a class="brand" href="/"><img src="/images/logo.jpeg" alt="Logotipo Cotech" width="56" height="56"><span>${esc(company.name || "COTECH")}<small>O FUTURO EM SUAS MÃOS</small></span></a><button class="mobile-toggle" data-menu aria-controls="main-nav" aria-expanded="false">Menu <span aria-hidden="true">☰</span></button><nav id="main-nav" aria-label="Principal"><a href="/">Início</a><a href="/servicos">Soluções</a><a href="/#sobre">A Cotech</a><a href="/blog">Conteúdos</a><a class="button" href="/orcamento">Vamos conversar ↗</a></nav></div></header><main id="main">${feedback ? `<div class="container">${feedback}</div>` : ""}${content}</main><footer class="footer"><div class="container"><div class="footer-grid"><div class="footer-brand"><a href="/" class="footer-wordmark">COTECH<span>▪</span></a><p>${esc(company.footer || "Conhecimento, proximidade e soluções para transformar o futuro do seu negócio.")}</p><span class="footer-tagline">O FUTURO EM SUAS MÃOS.</span></div><div><h3>Explore</h3><a href="/">Início</a><a href="/servicos">Nossas soluções</a><a href="/#sobre">A Cotech</a><a href="/blog">Conteúdos e ideias</a></div><div><h3>Vamos nos conectar</h3>${company.email ? `<a class="wrap" href="mailto:${esc(company.email)}">${esc(company.email)}</a>` : ""}${company.phone ? `<p>${esc(company.phone)}</p>` : ""}${company.address ? `<p>${esc(company.address)}</p>` : ""}<a href="${esc(wa(company))}">Conversar com a equipe ↗</a><a href="/login">Área da equipe ↗</a></div></div><div class="footer-bottom"><span>© ${new Date().getUTCFullYear()} Cotech. Todos os direitos reservados.</span><a href="/pagina/privacidade">Privacidade e uso de dados</a><a href="#main">De volta ao topo ↑</a></div></div></footer>${path === "/orcamento" ? "" : `<a class="contact-float" href="${esc(wa(company))}">Vamos conversar?</a>`}</body></html>`
    );
}
export const serviceCards = (items) =>
    items
        .map(
            (s, i) =>
                `<a class="solution-card" href="/servicos/${esc(s.slug)}" data-reveal><div class="solution-top"><span class="solution-icon">${["▥", "↗", "◎"][i % 3]}</span><span class="solution-number">${String(i + 1).padStart(2, "0")}</span></div><h3>${esc(s.title)}</h3><p>${esc(s.summary)}</p><div class="solution-link">Descubra as possibilidades <span>↗</span></div></a>`,
        )
        .join("");
export const postCards = (items) =>
    items
        .map(
            (p, i) =>
                `<article class="insight-card" data-reveal><a class="insight-cover cover-${i % 3}" href="/blog/${esc(p.slug)}" tabindex="-1" aria-hidden="true">${p.image && !["/images/contabilidade.jpeg", "/images/planejamento.jpeg", "/images/contadores.jpeg"].includes(p.image) ? `<img class="editorial-photo" src="${esc(p.image)}" alt="">` : `<span>COTECH / EM PERSPECTIVA</span><div class="editorial-shape shape-${i % 3}"></div><b>${String(i + 1).padStart(2, "0")}</b><span class="cover-arrow">↗</span>`}</a><div class="insight-meta"><span>${esc(p.category || "NEGÓCIOS & ESTRATÉGIA")}</span><span>${esc(stamp(p.published_at || p.created_at).split(",")[0])}</span></div><h3><a href="/blog/${esc(p.slug)}">${esc(p.title)}</a></h3><p>${esc(p.summary)}</p><a class="text-link" href="/blog/${esc(p.slug)}">Ler conteúdo ↗</a></article>`,
        )
        .join("");
export function home(c, items) {
    const company = c.get("company");
    const by = (type) => items.filter((x) => x.type === type);
    const title = company.hero_title;
    const slots = {
        HERO_TITLE:
            !title || title === "O próximo passo do seu negócio começa aqui."
                ? "O futuro do<br>seu negócio<br><em>começa agora.</em>"
                : esc(title),
        HERO_TEXT: esc(company.hero_text),
        SERVICES: serviceCards(by("service")),
        POSTS: postCards(
            by("post")
                .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
                .slice(0, 3),
        ),
        TEAM: by("team")
            .map(
                (p) =>
                    `<article class="person-card" data-reveal><div class="person-photo">${p.image ? `<img src="${esc(p.image)}" alt="${esc(p.title)}" loading="lazy" width="600" height="550">` : ""}<span class="person-mark">↗</span></div><div class="person-info"><h3>${esc(p.title)}</h3><span>${esc(p.summary)}</span></div></article>`,
            )
            .join(""),
        FAQ: by("faq")
            .map(
                (f, i) =>
                    `<details name="cotech-faq"><summary><span class="faq-number">${i + 1}</span>${esc(f.title)}<span class="faq-toggle">+</span></summary><p>${esc(f.body)}</p></details>`,
            )
            .join(""),
        EXTRA: items
            .filter(
                (x) =>
                    ["banner", "certification"].includes(x.type) ||
                    (x.type === "testimonial" && x.authorized),
            )
            .map(
                (x) =>
                    `<section class="section"><div class="container card">${x.image ? `<img src="${esc(x.image)}" alt="${esc(x.title)}" style="max-width:100%">` : ""}<h2>${esc(x.title)}</h2><p>${esc(x.summary)}</p><p class="prose">${esc(x.body)}</p></div></section>`,
            )
            .join(""),
    };
    return layout(
        c,
        "O futuro em suas mãos",
        homeTemplate.replace(/@@([A-Z_]+)@@/g, (_, key) => slots[key] || ""),
    );
}
export const pageHead = (title, subtitle = "") =>
    `<div class="page-head"><div class="container"><span class="eyebrow">COTECH</span><h1>${esc(title)}</h1><p class="muted">${esc(subtitle)}</p></div></div>`;
export function quote(c, services) {
    return layout(
        c,
        "Solicitar proposta",
        pageHead(
            "Seu próximo passo começa aqui.",
            "Conte o que precisa e nossa equipe entrará em contato.",
        ) +
            `<section class="section"><div class="container split">${form(c, "/orcamento", `<div class="form-grid">${input("name", "Nome completo *", "", "text", 'required maxlength="150"')}${input("phone", "Telefone / WhatsApp *", "", "tel", 'required minlength="8" maxlength="30"')}${input("email", "E-mail", "", "email", 'maxlength="190"')}${input("company", "Empresa")}${input("document", "Documento fiscal", "", "text", 'maxlength="30"')}${input("city", "Cidade")}${select("service_id", "Serviço de interesse", { "": "Preciso de orientação", ...options(services) }, c.req.query("service"))}${select("priority", "Prioridade", priorities, "normal")}${select("contact_preference", "Prefiro contato por", { whatsapp: "WhatsApp", email: "E-mail", phone: "Telefone" }, "whatsapp")}${textarea("message", "Como podemos ajudar? *", "", 'required minlength="10" maxlength="5000"')}${input("attachments", "Anexos (até 5 arquivos de 5 MB)", "", "file", 'multiple accept=".jpg,.jpeg,.png,.webp,.pdf"')}<div class="honeypot" aria-hidden="true">${input("website", "Website", "", "text", 'tabindex="-1" autocomplete="off"')}</div><label class="check full"><input type="checkbox" name="consent" value="1" required><span>Autorizo o uso dos dados para atendimento desta solicitação conforme a <a href="/pagina/privacidade" target="_blank" rel="noopener">política de privacidade</a>.</span></label></div><button>Enviar solicitação ↗</button>`, "POST", 'class="card" enctype="multipart/form-data"')}<aside class="card"><span class="eyebrow">Conte com a gente</span><h3>O que acontece depois?</h3><p>Recebemos sua solicitação, analisamos suas necessidades e entramos em contato pelo canal escolhido.</p></aside></div></section>`,
    );
}
export const leadTable = (leads) =>
    table(
        ["Contato", "Empresa", "Etapa", "Prioridade", "Recebido em"],
        leads.map((l) => [
            `<a class="text-link" href="/admin/leads/${l.id}">${esc(l.name)}</a><div>${esc(l.email || l.phone)}</div>`,
            esc(l.company),
            esc(l.stage_name),
            esc(priorities[l.priority]),
            esc(stamp(l.created_at)),
        ]),
    );
export function contentForm(c, item = {}) {
    return layout(
        c,
        "Editar conteúdo",
        `<a href="/admin/conteudos?type=${esc(item.type || "service")}">← Voltar</a><h1>${item.id ? "Editar" : "Adicionar"} conteúdo</h1>${form(c, "/admin/conteudos" + (item.id ? "/" + item.id : ""), `<div class="form-grid">${select("type", "Tipo", types, item.type || "service")}${input("sort", "Ordem", item.sort || 0, "number", 'min="0" max="9999" required')}${input("title", "Título", item.title, "text", 'required maxlength="190"')}${input("slug", "Endereço", item.slug, "text", 'required pattern="[a-z0-9]+(-[a-z0-9]+)*" maxlength="190"')}${input("category", "Categoria", item.category)}${input("seo_title", "Título para buscadores", item.seo_title)}${textarea("summary", "Resumo", item.summary, 'maxlength="1000"')}${textarea("body", "Conteúdo (texto simples)", item.body, 'rows="12" maxlength="50000"')}${textarea("meta_description", "Descrição para buscadores", item.meta_description, 'maxlength="320"')}${input("published_at", "Publicar a partir de (UTC)", item.published_at ? new Date(item.published_at).toISOString().slice(0, 16) : "", "datetime-local")}${input("ends_at", "Encerrar em (UTC)", item.ends_at ? new Date(item.ends_at).toISOString().slice(0, 16) : "", "datetime-local")}${input("image", "Imagem (até 5 MB)", "", "file", 'accept=".jpg,.jpeg,.png,.webp"')}${item.image ? `<img src="${esc(item.image)}" width="140" alt="Imagem atual">` : ""}<label class="check"><input type="checkbox" name="active" value="1" ${item.active ? "checked" : ""}>Publicar conteúdo</label><label class="check"><input type="checkbox" name="authorized" value="1" ${item.authorized ? "checked" : ""}>Tenho autorização para publicar o depoimento</label></div><button>Salvar conteúdo</button>`, item.id ? "PUT" : "POST", 'class="card" enctype="multipart/form-data"')}`,
        true,
    );
}

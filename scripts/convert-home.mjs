import fs from "node:fs";
import { load } from "cheerio";
const $ = load(
    fs.readFileSync("storage/app/private/deploy/home-source.html", "utf8"),
);
$(".future-copy h1").html("@@HERO_TITLE@@");
$(".future-copy > p").html("@@HERO_TEXT@@");
$(".solution-grid").html("@@SERVICES@@");
$(".team-grid").html("@@TEAM@@");
$(".insight-grid").html("@@POSTS@@");
$(".faq-list").html("@@FAQ@@");
$(".final-cta").before("@@EXTRA@@");
fs.mkdirSync("worker", { recursive: true });
fs.writeFileSync(
    "worker/home-template.js",
    "// Layout converted from the Laravel public home. Dynamic sections are rendered by views.js.\nexport default " +
        JSON.stringify($("#main").html()) +
        ";\n",
);
console.log("Home template converted.");

import fs from "node:fs";
import path from "node:path";
const output = path.resolve("build/cloudflare");
if (output !== path.join(process.cwd(), "build", "cloudflare"))
    throw new Error("Unexpected build directory");
fs.mkdirSync(output, { recursive: true });
for (const item of fs.readdirSync(output))
    fs.rmSync(path.join(output, item), { recursive: true, force: true });
for (const directory of ["css", "js", "images"])
    fs.cpSync(`public/${directory}`, `${output}/${directory}`, {
        recursive: true,
    });
console.log(
    "Public CSS, JavaScript and images prepared. PHP, credentials and private uploads excluded.",
);

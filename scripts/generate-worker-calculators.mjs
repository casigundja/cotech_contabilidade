import fs from 'node:fs';
import path from 'node:path';

function extractContent(filePath) {
    const text = fs.readFileSync(filePath, 'utf8');
    const startIdx = text.indexOf("@section('content')");
    if (startIdx === -1) throw new Error("No @section('content') in " + filePath);
    const contentStart = startIdx + "@section('content')".length;
    const endIdx = text.lastIndexOf("@endsection");
    if (endIdx === -1) throw new Error("No @endsection in " + filePath);
    return text.substring(contentStart, endIdx).trim();
}

const calcs = {
    abrirCnpj: 'resources/views/public/calculators/abrir-cnpj.blade.php',
    cltPj: 'resources/views/public/calculators/clt-pj.blade.php',
    fatorR: 'resources/views/public/calculators/fator-r.blade.php',
    rpa: 'resources/views/public/calculators/rpa-autonomo.blade.php',
    reforma: 'resources/views/public/calculators/reforma-tributaria.blade.php',
    courses: 'resources/views/public/courses.blade.php',
};

const templates = {};
for (const [key, relPath] of Object.entries(calcs)) {
    let content = extractContent(relPath);
    // Replace {{ $wa }} with a valid JS expression or placeholder
    content = content.replace(/\{\{\s*\$wa\s*\}\}/g, '@@WA_URL@@');
    templates[key] = content;
}

let fileContent = `// Auto-generated templates from blade views
import { esc, wa } from "./views.js";

function renderWithCompany(html, company) {
    const waUrl = esc(wa(company));
    return html.replaceAll('@@WA_URL@@', waUrl);
}
`;

for (const [key, rawHtml] of Object.entries(templates)) {
    fileContent += `\nexport function ${key}Template(c) {\n    const company = c.get("company") || {};\n    return renderWithCompany(${JSON.stringify(rawHtml)}, company);\n}\n`;
}

fs.writeFileSync('worker/calculator-templates.js', fileContent, 'utf8');
console.log('Successfully generated worker/calculator-templates.js');

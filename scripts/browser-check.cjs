const { chromium } = require(process.env.PLAYWRIGHT_MODULE || '@playwright/test');
const fs = require('node:fs');
const path = require('node:path');
(async () => {
  const browser = await chromium.launch({ channel: 'msedge', headless: true });
  const page = await browser.newPage();
  const errors = [];
  page.on('pageerror', error => errors.push(error.message));
  const base = process.env.APP_TEST_URL || 'http://127.0.0.1:8000';
  const out = path.join(__dirname, '../storage/app/checks');
  fs.mkdirSync(out, { recursive: true });
  try {
    for (const width of [1440, 390]) {
      await page.setViewportSize({width, height: 960});
      for (const route of ['/', '/servicos', '/blog', '/orcamento', '/login']) {
        const response = await page.goto(base + route);
        if (response.status() !== 200) throw new Error(`${route}: HTTP ${response.status()}`);
        if (!(await page.title()).includes('Cotech')) throw new Error(`${route}: expected Cotech page, received ${await page.title()}`);
        if (await page.evaluate(() => document.documentElement.scrollWidth > innerWidth + 1)) {
          console.log(await page.evaluate(()=>Array.from(document.querySelectorAll('body *')).filter(e=>e.getBoundingClientRect().right>innerWidth+1).map(e=>({tag:e.tagName,cls:e.className,width:e.getBoundingClientRect().width})).slice(0,15)));
          throw new Error(`${route}: overflow at ${width}`);
        }
        await page.locator('img').evaluateAll(async images => { await Promise.all(images.map(async image => { image.loading='eager'; try { await image.decode(); } catch {} })); });
        const broken = await page.locator('img').evaluateAll(images => images.filter(i => i.naturalWidth === 0).map(i => i.src));
        if (broken.length) throw new Error(`Broken images: ${broken.join(', ')}`);
        await page.screenshot({path:path.join(out, `${route === '/' ? 'home' : route.slice(1)}-${width}.png`),fullPage:true});
      }
      if (width === 390) {
        await page.getByRole('button', {name:'Menu', exact:true}).click();
        if (await page.getByRole('button', {name:'Menu', exact:true}).getAttribute('aria-expanded') !== 'true') throw new Error('Mobile menu did not open');
        await page.locator('#main-nav').getByRole('link', {name:'Soluções',exact:true}).click();
        await page.waitForURL('**/servicos');
      }
    }
    if (process.env.COTECH_TEST_EMAIL && process.env.COTECH_TEST_PASSWORD) {
      const contactName = 'Verificação local ' + Date.now();
      await page.goto(base+'/orcamento');
      await page.getByLabel('Nome completo').fill(contactName);
      await page.getByLabel('Telefone / WhatsApp').fill('923456789');
      await page.getByLabel('Como podemos ajudar?').fill('Solicitação de teste local para verificar o formulário e o painel.');
      await page.getByRole('checkbox').check();
      await page.getByRole('button',{name:'Enviar solicitação'}).click();
      await page.getByRole('status').filter({hasText:'recebida!'}).waitFor();
      await page.setViewportSize({width:1440,height:960});
      await page.goto(base+'/login');
      await page.getByLabel('E-mail', {exact:true}).fill(process.env.COTECH_TEST_EMAIL);
      await page.getByLabel('Senha', {exact:true}).fill(process.env.COTECH_TEST_PASSWORD);
      await page.getByRole('button',{name:'Entrar no painel'}).click();
      await page.waitForURL('**/admin');
      await page.goto(base+'/admin/leads');
      await page.getByLabel('Buscar nome ou empresa').fill(contactName);
      await page.getByRole('button',{name:'Filtrar',exact:true}).click();
      await page.getByRole('link',{name:contactName,exact:true}).click();
      await page.getByLabel('Nova anotação').fill('Fluxo confirmado no navegador.');
      await page.getByRole('button',{name:'Registrar interação'}).click();
      await page.getByText('Fluxo confirmado no navegador.',{exact:true}).waitFor();
      page.once('dialog',dialog=>dialog.accept());
      await page.getByRole('button',{name:'Excluir lead',exact:true}).click();
      await page.waitForURL('**/admin/leads');
      if(await page.getByRole('link',{name:contactName,exact:true}).count()) throw new Error('Test lead was not deleted');
      for (const width of [1440,390]) {
        await page.setViewportSize({width,height:960});
        for (const route of ['/admin','/admin/leads','/admin/kanban','/admin/clientes','/admin/solicitacoes','/admin/conteudos','/admin/configuracoes']) {
          const response=await page.goto(base+route);
          if(response.status()!==200) throw new Error(`${route}: HTTP ${response.status()}`);
          if(await page.evaluate(()=>document.documentElement.scrollWidth > innerWidth+1)) throw new Error(`${route}: overflow at ${width}`);
          await page.screenshot({path:path.join(out,`${route.replaceAll('/','-')}-${width}.png`),fullPage:true});
        }
      }
    }
    if(errors.length) throw new Error(errors.join('\n'));
    console.log('Browser checks passed: desktop/mobile pages, images, overflow and navigation. Screenshots: storage/app/checks');
  } finally { await browser.close(); }
})().catch(error=>{ console.error(error); process.exit(1); });

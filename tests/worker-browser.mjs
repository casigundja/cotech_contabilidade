import { chromium, expect } from '@playwright/test';
import fs from 'node:fs';
const base=process.env.WORKER_TEST_URL||'http://127.0.0.1:8787';
const browser=await chromium.launch({channel:'msedge',headless:true});
const page=await browser.newPage();
const errors=[];
page.on('pageerror',error=>errors.push(error.message));
fs.mkdirSync('storage/app/checks/worker',{recursive:true});
try {
 for(const width of [1440,390]) {
  await page.setViewportSize({width,height:1000});
  for(const route of ['/','/servicos','/blog','/orcamento','/login']) {
   const response=await page.goto(base+route);
   if(response.status()!==200)throw new Error(route+': HTTP '+response.status());
   await page.locator('img').evaluateAll(async images=>Promise.all(images.map(async image=>{image.loading='eager';await image.decode();})));
   if(await page.evaluate(()=>document.documentElement.scrollWidth>innerWidth+1))throw new Error(route+': horizontal overflow at '+width);
   if(route==='/') {
    await page.getByRole('tab',{name:/02/}).click();
    await expect(page.locator('#step-panel-1')).toBeVisible();
    await page.getByRole('tab',{name:/02/}).press('ArrowDown');
    await expect(page.locator('#step-panel-2')).toBeVisible();
    await page.locator('.faq-list summary').first().click();
    await expect(page.locator('.faq-list details').first()).toHaveAttribute('open','');
    for(const element of await page.locator('[data-reveal]').all()) await element.scrollIntoViewIfNeeded();
    await page.evaluate(()=>scrollTo({top:0,behavior:'instant'}));
    await page.screenshot({path:`storage/app/checks/worker/home-${width}.png`,fullPage:true});
    if(width===390){await page.getByRole('button',{name:'Menu',exact:true}).click();await expect(page.locator('#main-nav')).toBeVisible();await page.keyboard.press('Escape');await expect(page.getByRole('button',{name:'Menu',exact:true})).toHaveAttribute('aria-expanded','false');}
   }
  }
 }
 const access=fs.readFileSync('storage/app/private/local-access.txt','utf8');
 await page.goto(base+'/login');
 await page.locator('[name=email]').fill(access.match(/E-mail:\s*(\S+)/u)[1]);
 await page.locator('[name=password]').fill(access.match(/Senha:\s*(\S+)/u)[1]);
 await page.getByRole('button',{name:'Entrar',exact:true}).click();
 await page.waitForURL('**/admin');
 await expect(page.getByRole('heading',{name:'Visão geral',exact:true})).toBeVisible();
 for(const route of ['/admin/leads','/admin/kanban','/admin/clientes','/admin/solicitacoes','/admin/conteudos','/admin/configuracoes']) {
  const response=await page.goto(base+route);if(response.status()!==200)throw new Error(route+': HTTP '+response.status());
  if(await page.evaluate(()=>document.documentElement.scrollWidth>innerWidth+1))throw new Error(route+': mobile horizontal overflow');
 }
 await page.getByRole('button',{name:'Sair da conta',exact:true}).click();
 await page.waitForURL(base+'/');
 if(errors.length)throw new Error(errors.join('\n'));
 console.log('PASS: desktop/mobile pages, images, tabs/keyboard, FAQ, mobile menu, admin login, all admin sections, logout and no JavaScript errors.');
}finally{await browser.close();}

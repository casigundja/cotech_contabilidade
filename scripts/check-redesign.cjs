const { chromium, expect } = require(process.env.PLAYWRIGHT_MODULE || '@playwright/test');
const fs = require('node:fs');
(async () => {
  const browser = await chromium.launch({channel:'msedge',headless:true});
  const page = await browser.newPage();
  const errors=[];
  page.on('pageerror',error=>errors.push(error.message));
  const dir='storage/app/checks/redesign'; fs.mkdirSync(dir,{recursive:true});
  try {
    for(const width of [1440,768,390,320]) {
      await page.setViewportSize({width,height:1000});
      for(const route of ['/','/servicos','/blog','/orcamento','/login']) {
        const response=await page.goto('http://127.0.0.1:8000'+route);
        if(response.status()!==200) throw new Error(route+': '+response.status());
        await expect(page.locator('body')).toHaveClass('public-site');
        await page.locator('img').evaluateAll(async images=>Promise.all(images.map(async image=>{image.loading='eager';await image.decode();})));
        if(await page.evaluate(()=>document.documentElement.scrollWidth>innerWidth+1)) throw new Error(`Overflow: ${route} at ${width}`);
        if(route==='/') {
          await page.getByRole('tab',{name:/02/}).click();
          await expect(page.locator('#step-panel-1')).toBeVisible();
          await page.getByRole('tab',{name:/02/}).press('ArrowDown');
          await expect(page.locator('#step-panel-2')).toBeVisible();
          await page.getByRole('tab',{name:/01/}).click();
          await page.locator('.faq-list summary').first().click();
          await expect(page.locator('.faq-list details').first()).toHaveAttribute('open','');
          for(const element of await page.locator('[data-reveal]').all()) { await element.scrollIntoViewIfNeeded(); await expect(element).toHaveClass(/revealed/); }
          await page.evaluate(()=>scrollTo({top:0,behavior:'instant'}));
          await expect(page.locator('[data-reveal]').last()).toHaveClass(/revealed/);
          if(width<=650) {
            await page.getByRole('button',{name:'Menu',exact:true}).click();
            await expect(page.locator('#main-nav')).toBeVisible();
            await page.keyboard.press('Escape');
            await expect(page.getByRole('button',{name:'Menu',exact:true})).toHaveAttribute('aria-expanded','false');
          }
        }
        if(width===1440 || width===390) {
          await page.screenshot({path:`${dir}/${route==='/'?'home':route.slice(1)}-${width}.png`,fullPage:true,animations:'disabled'});
          if(route==='/') await page.screenshot({path:`${dir}/hero-${width}.png`,animations:'disabled'});
        }
      }
    }
    await page.emulateMedia({reducedMotion:'reduce'});
    await page.goto('http://127.0.0.1:8000');
    if(await page.locator('.ribbon-track').evaluate(e=>getComputedStyle(e).animationName)!=='none') throw new Error('Reduced motion not respected');
    if(await page.locator('[data-reveal]').first().evaluate(e=>getComputedStyle(e).opacity)!=='1') throw new Error('Reduced motion content hidden');
    if(errors.length) throw new Error(errors.join('\n'));
    console.log('Redesign passed: 20 page/viewport combinations, images, tabs, keyboard, FAQ, mobile menu, reduced motion, no JS errors.');
  } finally {await browser.close();}
})().catch(error=>{console.error(error);process.exit(1)});

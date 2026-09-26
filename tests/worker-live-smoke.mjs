import assert from 'node:assert/strict';
import fs from 'node:fs';
const origin='https://cotech-contabilidade.casimirogundja.workers.dev';
for(const path of ['/','/servicos','/blog','/orcamento']) {
 const response=await fetch(origin+path);assert.equal(response.status,200,path);assert.ok((await response.text()).includes('public-site'));
}
const login=await fetch(origin+'/login'),html=await login.text();assert.equal(login.status,200);
const credentials=fs.readFileSync('storage/app/private/local-access.txt','utf8');
const token=html.match(/name="_token" value="([a-f0-9]+)"/)[1];
const form=new URLSearchParams({_token:token,email:credentials.match(/E-mail:\s*(\S+)/u)[1],password:credentials.match(/Senha:\s*(\S+)/u)[1]});
const authenticated=await fetch(origin+'/login',{method:'POST',headers:{origin,cookie:login.headers.get('set-cookie').split(';')[0]},body:form,redirect:'manual'});
assert.equal(authenticated.status,303);const session=authenticated.headers.get('set-cookie');assert.ok(session.includes('Secure'));assert.ok(session.includes('HttpOnly'));const cookie=session.split(';')[0];
const dashboard=await fetch(origin+'/admin',{headers:{cookie}});assert.equal(dashboard.status,200);const dashboardHtml=await dashboard.text();assert.ok(dashboardHtml.includes('Visão geral'));
const logout=await fetch(origin+'/logout',{method:'POST',headers:{origin,cookie},body:new URLSearchParams({_token:dashboardHtml.match(/name="_token" value="([a-f0-9]+)"/)[1]}),redirect:'manual'});assert.equal(logout.status,303);
assert.equal((await fetch(origin+'/admin',{headers:{cookie},redirect:'manual'})).status,302);
assert.equal((await fetch(origin+'/.env')).status,404);
console.log('PASS: production site, services, blog, quote form, administrator login, secure cookies, dashboard, logout/session revocation, and no exposed .env.');

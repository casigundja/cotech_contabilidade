import assert from 'node:assert/strict';
import fs from 'node:fs';
import postgres from 'postgres';
const origin='https://conversao-cotech-contabilidade.casimirogundja.workers.dev';
const config=JSON.parse(fs.readFileSync('storage/app/private/deploy/worker-db.json','utf8'));
const sql=postgres({...config,username:config.user,ssl:'require',max:1,prepare:false});
const name='upload-preview-'+Date.now();
try {
 const page=await fetch(origin+'/orcamento');assert.equal(page.status,200);
 const html=await page.text(), token=html.match(/name="_token" value="([a-f0-9]+)"/)[1];
 const form=new FormData();
 for(const [key,value]of Object.entries({_token:token,name,phone:'11999999999',email:'preview@example.invalid',message:'Teste temporário de cinco anexos no limite de tamanho.',priority:'normal',contact_preference:'phone',consent:'1'}))form.set(key,value);
 const data=new Uint8Array(5*1024*1024);data.set(new TextEncoder().encode('%PDF-1.4\n'));
 for(let i=0;i<5;i++)form.append('attachments',new File([data],`test-${i}.pdf`,{type:'application/pdf'}));
 const response=await fetch(origin+'/orcamento',{method:'POST',headers:{origin,cookie:page.headers.get('set-cookie').split(';')[0]},body:form,redirect:'manual'});
 assert.equal(response.status,303,(await response.text()).slice(0,500));
 const [result]=await sql`SELECT count(*)::int count,sum(octet_length(f.data))::int bytes FROM cotech.worker_files f JOIN cotech.media m ON m.id=f.media_id JOIN cotech.leads l ON l.id=m.lead_id WHERE l.name=${name}`;
 assert.equal(result.count,5);assert.equal(result.bytes,25*1024*1024);
 console.log('PASS: Cloudflare accepted and persisted five private 5 MB attachments (25 MB total).');
}finally{
 const leads=await sql`SELECT id FROM cotech.leads WHERE name=${name}`;
 for(const lead of leads){await sql`DELETE FROM cotech.worker_mail WHERE subject=${'Novo orçamento Cotech #'+lead.id}`;await sql`DELETE FROM cotech.audit_logs WHERE entity='lead' AND entity_id=${lead.id}`;await sql`DELETE FROM cotech.leads WHERE id=${lead.id}`;}
 await sql.end();
}

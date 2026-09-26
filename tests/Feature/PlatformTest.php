<?php
namespace Tests\Feature;
use App\Jobs\SendLeadNotification;
use App\Models\{Content,Customer,Lead,LeadStatus,User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\{DB,Hash,Queue,Storage,Notification,Password};
use Tests\TestCase;
class PlatformTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void { parent::setUp(); $this->seed(); }
    private function user(string $role='admin'): User { return User::factory()->create(['role'=>$role]); }
    private function payload(): array { return ['name'=>'Maria Silva','phone'=>'+244923456789','email'=>'maria@example.test','message'=>'Gostaria de uma proposta para minha empresa.','priority'=>'normal','contact_preference'=>'email','consent'=>'1']; }
    private function lead(): Lead { return Lead::create($this->leadData()); }
    private function leadData(): array { $data=$this->payload(); unset($data['consent']); return $data+['status_id'=>LeadStatus::where('name','Novo')->first()->id,'consent_version'=>'test','consented_at'=>now()]; }

    public function test_public_pages_render_and_unknown_pages_return_404(): void
    {
        foreach (['/','/servicos','/blog','/orcamento','/servicos/contabilidade-empresarial','/blog/clareza-nas-decisoes','/pagina/privacidade','/login','/forgot-password','/reset-password/test-token','/sitemap.xml','/robots.txt'] as $path) $this->get($path)->assertOk();
        $this->get('/servicos/inexistente')->assertNotFound();
        $xml = $this->get('/sitemap.xml')->getContent();
        $this->assertNotFalse(simplexml_load_string($xml));
    }
    public function test_quote_stores_private_attachments_consent_attribution_and_notification(): void
    {
        Queue::fake(); Storage::fake('local');
        $this->get('/orcamento?utm_source=campanha&utm_campaign=setembro')->assertOk();
        $this->post('/orcamento',$this->payload()+['attachments'=>[UploadedFile::fake()->create('briefing.pdf',20,'application/pdf')]])->assertRedirect('/orcamento')->assertSessionHas('success');
        $lead=Lead::firstOrFail();
        $this->assertSame('campanha',$lead->source);
        $this->assertSame('setembro',$lead->attribution['utm_campaign']);
        $this->assertNotNull($lead->consented_at);
        $this->assertCount(1,$lead->interactions);
        $media=DB::table('media')->first(); Storage::disk('local')->assertExists($media->path);
        Queue::assertPushed(SendLeadNotification::class);
        $this->get('/admin/media/'.$media->id)->assertRedirect('/login');
        $this->actingAs($this->user('editor'))->get('/admin/media/'.$media->id)->assertForbidden();
        $this->actingAs($this->user())->get('/admin/media/'.$media->id)->assertOk()->assertDownload('briefing.pdf');
    }
    public function test_quote_rejects_missing_consent_email_preference_without_email_and_honeypot(): void
    {
        $data=$this->payload(); unset($data['consent']);
        $this->post('/orcamento',$data)->assertSessionHasErrors('consent');
        $data=$this->payload(); $data['email']='';
        $this->post('/orcamento',$data)->assertSessionHasErrors('email');
        $this->post('/orcamento',$this->payload()+['website'=>'bot.example'])->assertSessionHasErrors('website');
        $this->assertDatabaseCount('leads',0);
    }
    public function test_unpublished_services_cannot_receive_quotes(): void
    {
        $service=Content::where('type','service')->first(); $service->update(['published_at'=>now()->addDay()]);
        $this->get('/servicos/'.$service->slug)->assertNotFound();
        $this->post('/orcamento',$this->payload()+['service_id'=>$service->id])->assertSessionHasErrors('service_id');
    }
    public function test_all_admin_pages_render_with_real_data(): void
    {
        $lead=$this->lead(); $item=Content::first(); $this->actingAs($this->user());
        foreach (['/admin','/admin/leads','/admin/kanban','/admin/leads/'.$lead->id,'/admin/clientes','/admin/solicitacoes','/admin/conteudos','/admin/conteudos/novo','/admin/conteudos/'.$item->id.'/editar','/admin/configuracoes'] as $path) $this->get($path)->assertOk();
    }
    public function test_roles_enforce_commercial_content_and_administration_boundaries(): void
    {
        $this->get('/admin')->assertRedirect('/login');
        $this->actingAs($this->user('editor'));
        $this->get('/admin')->assertRedirect('/admin/conteudos');
        $this->get('/admin/leads')->assertForbidden(); $this->get('/admin/configuracoes')->assertForbidden();
        $this->get('/admin/conteudos')->assertOk();
        $this->actingAs($this->user('attendant'));
        $this->get('/admin')->assertOk(); $this->get('/admin/conteudos')->assertForbidden(); $this->get('/admin/configuracoes')->assertForbidden();
        $this->post('/admin/usuarios',[])->assertForbidden();
        $this->delete('/admin/leads/'.$this->lead()->id)->assertForbidden();
    }
    public function test_lead_can_be_updated_annotated_and_converted_exactly_once(): void
    {
        $lead=$this->lead(); $user=$this->user(); $this->actingAs($user);
        $this->patch('/admin/leads/'.$lead->id,['status_id'=>LeadStatus::where('name','Em contato')->first()->id,'priority'=>'high','assigned_to'=>$user->id])->assertSessionHasNoErrors();
        $this->post('/admin/leads/'.$lead->id.'/interactions',['message'=>'Cliente contatado.'])->assertSessionHasNoErrors();
        $this->post('/admin/leads/'.$lead->id.'/convert')->assertSessionHasNoErrors();
        $this->post('/admin/leads/'.$lead->id.'/convert')->assertSessionHasNoErrors();
        $this->assertDatabaseCount('customers',1); $this->assertDatabaseCount('service_requests',1);
        $this->assertNotNull($lead->fresh()->customer_id);
        $this->assertSame('won',$lead->fresh()->stage->outcome);
        $request=DB::table('service_requests')->first();
        $this->patch('/admin/solicitacoes/'.$request->id,['status'=>'Concluída'])->assertSessionHasNoErrors();
        $this->assertDatabaseHas('service_requests',['id'=>$request->id,'status'=>'Concluída']);
        $this->get('/admin/clientes')->assertOk()->assertSee('Maria Silva');
        $this->get('/admin/solicitacoes')->assertOk()->assertSee('Concluída');
    }
    public function test_content_publication_scheduling_escaping_and_authorization(): void
    {
        $this->actingAs($this->user('editor'));
        $data=['type'=>'post','title'=>'Artigo de teste','slug'=>'artigo-teste','body'=>'<script>alert(1)</script>','sort'=>0,'active'=>1];
        $this->post('/admin/conteudos',$data)->assertRedirect('/admin/conteudos?type=post')->assertSessionHasNoErrors();
        $this->get('/blog/artigo-teste')->assertOk()->assertSee('&lt;script&gt;',false)->assertDontSee('<script>alert(1)</script>',false);
        $item=Content::where('slug','artigo-teste')->firstOrFail();
        $this->put('/admin/conteudos/'.$item->id,$data+['published_at'=>now()->addDay()->toDateTimeString()])->assertSessionHasNoErrors();
        $this->get('/blog/artigo-teste')->assertNotFound();
        $data['type']='testimonial'; $data['slug']='depoimento-teste';
        $this->post('/admin/conteudos',$data)->assertSessionHasErrors('authorized');
        $this->delete('/admin/conteudos/'.$item->id)->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('contents',['id'=>$item->id]);
    }
    public function test_settings_customers_stages_and_users_can_be_created(): void
    {
        $this->actingAs($this->user());
        $this->post('/admin/configuracoes',['name'=>'Cotech','hero_title'=>'Novo título','hero_text'=>'Novo texto','email'=>'contato@example.test'])->assertSessionHasNoErrors();
        $this->get('/')->assertSee('Novo título');
        $this->post('/admin/clientes',['name'=>'Cliente direto','phone'=>'923456789','type'=>'company'])->assertSessionHasNoErrors();
        $this->assertDatabaseHas('customers',['name'=>'Cliente direto']);
        $this->post('/admin/etapas',['name'=>'Em análise','sort'=>25,'color'=>'#123456'])->assertSessionHasNoErrors();
        $this->assertDatabaseHas('lead_statuses',['name'=>'Em análise']);
        $this->post('/admin/usuarios',['name'=>'Editor','email'=>'editor@example.test','password'=>'UmaSenhaForte123!','role'=>'editor'])->assertSessionHasNoErrors();
        $this->assertTrue(Hash::check('UmaSenhaForte123!',User::where('email','editor@example.test')->first()->password));
    }
    public function test_login_logout_and_password_reset(): void
    {
        Notification::fake();
        $user=$this->user();
        $this->post('/login',['email'=>$user->email,'password'=>'errada'])->assertSessionHasErrors('email');
        $this->post('/login',['email'=>$user->email,'password'=>'password'])->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
        $this->post('/logout')->assertRedirect('/'); $this->assertGuest();
        $this->post('/forgot-password',['email'=>$user->email])->assertSessionHas('success');
        Notification::assertSentTo($user,\Illuminate\Auth\Notifications\ResetPassword::class);
        $token=Password::createToken($user);
        $this->post('/reset-password',['email'=>$user->email,'token'=>$token,'password'=>'OutraSenhaForte123!','password_confirmation'=>'OutraSenhaForte123!'])->assertRedirect('/login');
        $this->assertTrue(Hash::check('OutraSenhaForte123!',$user->fresh()->password));
    }
    public function test_seed_is_repeatable_and_preserves_edited_content(): void
    {
        $item=Content::first(); $item->update(['title'=>'Título personalizado']); $count=Content::count();
        $this->seed(); $this->assertSame($count,Content::count()); $this->assertSame('Título personalizado',$item->fresh()->title);
    }
    public function test_deleting_lead_removes_private_files_and_interactions(): void
    {
        Queue::fake(); Storage::fake('local');
        $this->post('/orcamento',$this->payload()+['attachments'=>[UploadedFile::fake()->create('briefing.pdf',10,'application/pdf')]])->assertSessionHasNoErrors();
        $lead=Lead::firstOrFail(); $path=DB::table('media')->first()->path;
        $this->actingAs($this->user())->delete('/admin/leads/'.$lead->id)->assertRedirect('/admin/leads');
        Storage::disk('local')->assertMissing($path);
        $this->assertDatabaseCount('leads',0); $this->assertDatabaseCount('media',0); $this->assertDatabaseCount('lead_interactions',0);
    }
    public function test_image_upload_is_saved_and_displayed(): void
    {
        Storage::fake('public');
        $this->actingAs($this->user('editor'));
        $image=UploadedFile::fake()->createWithContent('image.png',base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+a2ioAAAAASUVORK5CYII='));
        $this->post('/admin/conteudos',['type'=>'post','title'=>'Com imagem','slug'=>'com-imagem','summary'=>'Texto','sort'=>0,'active'=>1,'image'=>$image])->assertSessionHasNoErrors();
        $item=Content::where('slug','com-imagem')->firstOrFail();
        Storage::disk('public')->assertExists(substr($item->image,9));
        $this->get('/blog/com-imagem')->assertOk()->assertSee($item->image);
    }
    public function test_quote_rate_limit_blocks_repeated_submissions(): void
    {
        Queue::fake();
        for($i=0;$i<5;$i++) $this->post('/orcamento',$this->payload())->assertRedirect('/orcamento');
        $this->post('/orcamento',$this->payload())->assertStatus(429);
        $this->assertDatabaseCount('leads',5);
    }
}

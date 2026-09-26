<?php
namespace App\Http\Controllers;
use App\Models\{Content,Lead,LeadStatus};
use App\Jobs\SendLeadNotification;
use App\Support\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Storage};
use Illuminate\Validation\Rule;
class PublicController extends Controller {
 public function home(Request $r) {
  return view('public.home',['services'=>Content::published()->where('type','service')->get(),'posts'=>Content::published()->where('type','post')->latest()->take(3)->get(),'team'=>Content::published()->where('type','team')->get(),'faqs'=>Content::published()->where('type','faq')->get(),'testimonials'=>Content::published()->where('type','testimonial')->where('authorized',true)->get(),'banners'=>Content::published()->where('type','banner')->get(),'certifications'=>Content::published()->where('type','certification')->get()]);
 }
 public function listing(string $type) { return view('public.listing',['type'=>$type,'items'=>Content::published()->where('type',$type)->paginate(12)]); }
 public function show(string $type,string $slug) { $item=Content::published()->where(compact('type','slug'))->firstOrFail(); return view('public.detail',compact('item')); }
 public function quote() { return view('public.quote',['services'=>Content::published()->where('type','service')->get()]); }
 public function store(Request $r) {
  $data=$r->validate(['name'=>'required|string|max:150','phone'=>'required|string|min:8|max:30','email'=>'required_if:contact_preference,email|nullable|email|max:190','company'=>'nullable|string|max:190','document'=>'nullable|string|max:30','city'=>'nullable|string|max:150','service_id'=>['nullable','integer',function($attribute,$value,$fail) { if(!Content::published()->where('type','service')->whereKey($value)->exists()) $fail('O serviço selecionado não está disponível.'); }],'message'=>'required|string|min:10|max:5000','priority'=>'required|in:normal,high,urgent','contact_preference'=>'required|in:whatsapp,email,phone','consent'=>'accepted','attachments'=>'nullable|array|max:5','attachments.*'=>'file|mimes:jpg,jpeg,png,webp,pdf|max:5120','website'=>'nullable|string|max:0']);
  unset($data['consent'],$data['attachments'],$data['website']); $paths=[];
  try { $lead=DB::transaction(function() use($r,$data,&$paths) {
   $lead=Lead::create($data+['status_id'=>LeadStatus::orderBy('sort')->firstOrFail()->id,'consent_version'=>'2026-09-v1','consented_at'=>now(),'attribution'=>array_merge($r->session()->get('attribution',[]),['conversion_page'=>$r->headers->get('referer')]),'source'=>$r->session()->get('attribution.utm_source','site')]);
   foreach($r->file('attachments',[]) as $file) { $path=$file->store('leads/'.$lead->id,'local'); $paths[]=$path; DB::table('media')->insert(['lead_id'=>$lead->id,'path'=>$path,'name'=>$file->getClientOriginalName(),'mime'=>$file->getMimeType(),'created_at'=>now(),'updated_at'=>now()]); }
   $lead->interactions()->create(['message'=>'Solicitação recebida pelo site.']); Company::audit('created','lead',$lead->id); SendLeadNotification::dispatch($lead->id)->afterCommit(); return $lead;
  }); } catch(\Throwable $e) { foreach($paths as $path) Storage::disk('local')->delete($path); throw $e; }
  return redirect('/orcamento')->with('success','Solicitação #'.$lead->id.' recebida! Nossa equipe entrará em contato.');
 }
}

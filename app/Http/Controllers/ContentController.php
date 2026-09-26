<?php
namespace App\Http\Controllers;
use App\Models\Content;
use App\Support\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
class ContentController extends Controller {
 public const TYPES=['service'=>'Serviços','category'=>'Categorias de serviços','post'=>'Artigos','post_category'=>'Categorias do blog','tag'=>'Tags','page'=>'Páginas','banner'=>'Banners','testimonial'=>'Depoimentos','team'=>'Equipe','certification'=>'Certificações','faq'=>'Perguntas frequentes','location'=>'Regiões atendidas'];
 public function index(Request $r) { Gate::authorize('content'); $type=$r->input('type','service'); abort_unless(isset(self::TYPES[$type]),404); return view('admin.content',['items'=>Content::where('type',$type)->orderBy('sort')->latest()->paginate(20),'type'=>$type,'types'=>self::TYPES]); }
 public function edit(?Content $content=null) { Gate::authorize('content'); $type=$content?->type ?? request('type','service'); abort_unless(isset(self::TYPES[$type]),404); return view('admin.content-edit',['item'=>$content ?? new Content(['type'=>$type]),'types'=>self::TYPES]); }
 public function save(Request $r,?Content $content=null) { Gate::authorize('content'); $data=$r->validate(['type'=>['required',Rule::in(array_keys(self::TYPES))],'title'=>'required|string|max:190','slug'=>['required','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/','max:190',Rule::unique('contents')->ignore($content?->id)],'category'=>'nullable|string|max:100','summary'=>'nullable|string|max:1000','body'=>'nullable|string|max:50000','seo_title'=>'nullable|string|max:190','meta_description'=>'nullable|string|max:320','sort'=>'required|integer|min:0|max:9999','published_at'=>'nullable|date','ends_at'=>'nullable|date|after:published_at','image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5120','active'=>'nullable|boolean','authorized'=>'nullable|boolean']); unset($data['image']); $data['active']=$r->boolean('active'); $data['authorized']=$r->boolean('authorized'); if($data['type']==='testimonial' && $data['active'] && !$data['authorized']) return back()->withInput()->withErrors(['authorized'=>'Confirme a autorização antes de publicar este depoimento.']); if($r->hasFile('image')) $data['image']='/storage/'.$r->file('image')->store('content','public'); $content ??= new Content; $content->fill($data)->save(); Company::audit('saved','content',$content->id); return redirect('/admin/conteudos?type='.$content->type)->with('success','Conteúdo salvo.'); }
 public function delete(Content $content) { Gate::authorize('content'); Company::audit('deleted','content',$content->id); $content->delete(); return back()->with('success','Conteúdo excluído.'); }
}

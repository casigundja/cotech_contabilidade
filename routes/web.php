<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PublicController,AuthController,AdminController,ContentController};
use App\Models\Content;
Route::get('/',[PublicController::class,'home'])->name('home');
Route::get('/servicos',fn()=>app(PublicController::class)->listing('service'));
Route::get('/servicos/{slug}',fn($slug)=>app(PublicController::class)->show('service',$slug));
Route::get('/blog',fn()=>app(PublicController::class)->listing('post'));
Route::get('/blog/{slug}',fn($slug)=>app(PublicController::class)->show('post',$slug));
Route::get('/pagina/{slug}',fn($slug)=>app(PublicController::class)->show('page',$slug));
Route::get('/orcamento',[PublicController::class,'quote']);
Route::post('/orcamento',[PublicController::class,'store'])->middleware('throttle:5,1');
Route::get('/sitemap.xml',fn()=>response()->view('public.sitemap',['items'=>Content::published()->whereIn('type',['service','post','page'])->get()])->header('Content-Type','application/xml'));
Route::get('/robots.txt',fn()=>response("User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: ".url('/sitemap.xml'))->header('Content-Type','text/plain'));
Route::middleware('guest')->group(function(){
 Route::view('/login','auth.login')->name('login'); Route::post('/login',[AuthController::class,'login'])->middleware('throttle:5,1');
 Route::view('/forgot-password','auth.forgot')->name('password.request'); Route::post('/forgot-password',[AuthController::class,'forgot'])->middleware('throttle:3,1')->name('password.email');
 Route::get('/reset-password/{token}',fn($token)=>view('auth.reset',['token'=>$token]))->name('password.reset'); Route::post('/reset-password',[AuthController::class,'reset'])->middleware('throttle:5,1')->name('password.update');
});
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth');
Route::prefix('admin')->middleware('auth')->group(function(){
 Route::get('/',function(){ return auth()->user()->role==='editor' ? redirect('/admin/conteudos') : app(AdminController::class)->dashboard(request()); });
 Route::get('/leads',[AdminController::class,'leads']); Route::get('/kanban',[AdminController::class,'kanban']);
 Route::get('/leads/{lead}',[AdminController::class,'lead']); Route::patch('/leads/{lead}',[AdminController::class,'updateLead']); Route::delete('/leads/{lead}',[AdminController::class,'deleteLead']);
 Route::post('/leads/{lead}/interactions',[AdminController::class,'note']); Route::post('/leads/{lead}/convert',[AdminController::class,'convert']); Route::get('/media/{id}',[AdminController::class,'download']);
 Route::get('/clientes',[AdminController::class,'customers']); Route::post('/clientes',[AdminController::class,'customerStore']);
 Route::get('/solicitacoes',[AdminController::class,'requests']); Route::patch('/solicitacoes/{id}',[AdminController::class,'requestUpdate']);
 Route::get('/conteudos',[ContentController::class,'index']); Route::get('/conteudos/novo',[ContentController::class,'edit']); Route::post('/conteudos',[ContentController::class,'save']); Route::get('/conteudos/{content}/editar',[ContentController::class,'edit']); Route::put('/conteudos/{content}',[ContentController::class,'save']); Route::delete('/conteudos/{content}',[ContentController::class,'delete']);
 Route::get('/configuracoes',[AdminController::class,'settings']); Route::post('/configuracoes',[AdminController::class,'saveSettings']); Route::post('/usuarios',[AdminController::class,'userStore']); Route::post('/etapas',[AdminController::class,'stageStore']);
});

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Password,Hash};
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
class AuthController extends Controller {
 public function login(Request $r) { $data=$r->validate(['email'=>'required|email','password'=>'required|string']); if(!Auth::attempt($data,$r->boolean('remember'))) return back()->withErrors(['email'=>'E-mail ou senha incorretos.'])->onlyInput('email'); $r->session()->regenerate(); \App\Support\Company::audit('login','user',auth()->id()); return redirect()->intended('/admin'); }
 public function logout(Request $r) { Auth::logout(); $r->session()->invalidate(); $r->session()->regenerateToken(); return redirect('/'); }
 public function forgot(Request $r) { $r->validate(['email'=>'required|email']); Password::sendResetLink($r->only('email')); return back()->with('success','Se o e-mail estiver cadastrado, você receberá um link de recuperação.'); }
 public function reset(Request $r) { $r->validate(['token'=>'required','email'=>'required|email','password'=>'required|confirmed|min:12']); $status=Password::reset($r->only('email','password','password_confirmation','token'),function($user,$password) { $user->forceFill(['password'=>Hash::make($password),'remember_token'=>Str::random(60)])->save(); event(new PasswordReset($user)); }); return $status===Password::PASSWORD_RESET ? redirect('/login')->with('success','Senha atualizada. Entre com sua nova senha.') : back()->withErrors(['email'=>'Link inválido ou expirado. Solicite outro link.']); }
}

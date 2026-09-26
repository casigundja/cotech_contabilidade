<?php
namespace App\Support;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class Company {
 public static function all(): array { return Cache::remember('company',300,fn()=>DB::table('settings')->pluck('value','key')->all()); }
 public static function get(string $key, string $default=''): string { return self::all()[$key] ?? $default; }
 public static function whatsapp(string $service=''): ?string { $number=preg_replace('/\D/','',self::get('whatsapp')); return $number ? 'https://wa.me/'.$number.'?text='.rawurlencode('Olá, gostaria de saber mais sobre '.($service ?: 'os serviços da Cotech').'.') : null; }
 public static function audit(string $action,string $entity,?int $id=null): void { DB::table('audit_logs')->insert(['user_id'=>auth()->id(),'action'=>$action,'entity'=>$entity,'entity_id'=>$id,'created_at'=>now(),'updated_at'=>now()]); }
}

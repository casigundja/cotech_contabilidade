<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Content extends Model {
 protected $guarded = ['id'];
 protected function casts(): array { return ['active'=>'boolean','authorized'=>'boolean','extra'=>'array','published_at'=>'datetime','ends_at'=>'datetime']; }
 public function scopePublished($q) { return $q->where('active',true)->where(fn($q)=>$q->whereNull('published_at')->orWhere('published_at','<=',now()))->where(fn($q)=>$q->whereNull('ends_at')->orWhere('ends_at','>',now()))->orderBy('sort'); }
}

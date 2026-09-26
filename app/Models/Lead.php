<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lead extends Model {
 protected $guarded = ['id'];
 protected function casts(): array { return ['attribution'=>'array','consented_at'=>'datetime']; }
 public function service() { return $this->belongsTo(Content::class,'service_id'); }
 public function stage() { return $this->belongsTo(LeadStatus::class,'status_id'); }
 public function interactions() { return $this->hasMany(LeadInteraction::class)->latest(); }
}

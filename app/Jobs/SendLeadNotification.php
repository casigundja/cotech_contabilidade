<?php
namespace App\Jobs;
use App\Models\Lead;
use App\Support\Company;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
class SendLeadNotification implements ShouldQueue {
 use Queueable;
 public int $tries=3;
 public function __construct(public int $leadId) {}
 public function handle(): void {
  $lead=Lead::find($this->leadId); if(!$lead) return;
  if($email=Company::get('email')) Mail::raw('Nova solicitação #'.$lead->id.'. Acesse o painel: '.url('/admin/leads/'.$lead->id),fn($m)=>$m->to($email)->subject('Cotech · Nova solicitação'));
  if($lead->email) Mail::raw('Olá, '.$lead->name.'. Recebemos sua solicitação #'.$lead->id.'. Nossa equipe entrará em contato. Obrigado por escolher a Cotech.',fn($m)=>$m->to($lead->email)->subject('Cotech · Solicitação recebida'));
 }
}

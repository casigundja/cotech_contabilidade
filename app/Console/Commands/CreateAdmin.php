<?php
namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
class CreateAdmin extends Command
{
    protected $signature = 'cotech:admin {email?} {--name=Administrador Cotech} {--generate : Gera credenciais privadas apenas no ambiente local}';
    protected $description = 'Cria um administrador com senha informada de forma privada';
    public function handle(): int
    {
        $email = $this->argument('email') ?: $this->ask('E-mail do administrador');
        if ($this->option('generate') && !app()->environment('local')) {
            $this->error('A geração de credenciais em arquivo está disponível somente no ambiente local.');
            return self::FAILURE;
        }
        $password = $this->option('generate') ? bin2hex(random_bytes(12)) : $this->secret('Senha (mínimo de 12 caracteres)');
        $data = ['name'=>$this->option('name'), 'email'=>$email, 'password'=>$password];
        $validator = Validator::make($data,['name'=>'required|string|max:150','email'=>'required|email|max:190|unique:users','password'=>'required|string|min:12']);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) $this->error($error);
            return self::FAILURE;
        }
        User::create($data+['role'=>'admin']);
        if ($this->option('generate')) {
            \Illuminate\Support\Facades\Storage::disk('local')->put('local-access.txt', 'URL: '.url('/login').PHP_EOL.'E-mail: '.$email.PHP_EOL.'Senha: '.$password.PHP_EOL);
            $this->info('Credenciais locais salvas em storage/app/private/local-access.txt.');
        }
        $this->info('Administrador criado. Acesse /login.');
        return self::SUCCESS;
    }
}

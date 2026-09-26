<?php
require __DIR__.'/../vendor/autoload.php';
$private=__DIR__.'/../storage/app/private/deploy';
$env=Dotenv\Dotenv::createArrayBacked($private,'database.env')->load();
$pdo=new PDO('pgsql:host='.$env['DB_HOST'].';port=5432;dbname=postgres;sslmode=require;connect_timeout=10',$env['DB_USERNAME'],$env['DB_PASSWORD'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
$pdo->exec(file_get_contents(__DIR__.'/../worker/schema.sql'));
if (!is_file($private.'/worker-db.json')) {
 $password=bin2hex(random_bytes(32));
 $exists=$pdo->query("SELECT 1 FROM pg_roles WHERE rolname='cotech_worker'")->fetchColumn();
 if($exists) throw new RuntimeException('Role already exists; recover its credentials before continuing.');
 $pdo->exec('CREATE ROLE cotech_worker LOGIN PASSWORD '.$pdo->quote($password));
 file_put_contents($private.'/worker-db.json',json_encode(['host'=>$env['DB_HOST'],'port'=>5432,'database'=>'postgres','user'=>'cotech_worker','password'=>$password],JSON_PRETTY_PRINT));
}
$pdo->exec('GRANT USAGE ON SCHEMA cotech TO cotech_worker; GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA cotech TO cotech_worker; GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA cotech TO cotech_worker');
// Keep the existing local administrator's credentials when bootstrapping the first online account.
if (!$pdo->query('SELECT count(*) FROM cotech.users')->fetchColumn()) {
 $access=file_get_contents(__DIR__.'/../storage/app/private/local-access.txt');
 if(!preg_match('/E-mail:\s*(\S+)/u',$access,$email) || !preg_match('/Senha:\s*(\S+)/u',$access,$pass)) throw new RuntimeException('Local admin credentials unavailable.');
 $salt=bin2hex(random_bytes(32));
 $hash='pbkdf2$100000$'.$salt.'$'.hash_pbkdf2('sha256',$pass[1],hex2bin($salt),100000,64);
 $statement=$pdo->prepare("INSERT INTO cotech.users(name,email,password,role,created_at,updated_at) VALUES ('Administrador Cotech',?,?,'admin',now(),now())");
 $statement->execute([$email[1],$hash]);
 echo "Online administrator initialized with the existing private local credentials.\n";
}
foreach(['email'=>'comercial@cotechcontabilidade.com.br','phone'=>'(19) 98153-0690','whatsapp'=>'5519981530690'] as $key=>$value) {
 $statement=$pdo->prepare("INSERT INTO cotech.settings(key,value) VALUES (?,?) ON CONFLICT(key) DO UPDATE SET value=excluded.value WHERE settings.value IS NULL OR settings.value=''"); $statement->execute([$key,$value]);
}
echo "Worker schema and restricted database role ready.\n";

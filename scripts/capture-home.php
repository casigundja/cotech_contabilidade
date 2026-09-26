<?php
require __DIR__.'/../vendor/autoload.php';
foreach (['SESSION_DRIVER'=>'array','CACHE_STORE'=>'array','APP_DEBUG'=>'false'] as $key=>$value) { putenv($key.'='.$value); $_ENV[$key]=$_SERVER[$key]=$value; }
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('https://cotech-contabilidade.casimirogundja.workers.dev/');
$response = $kernel->handle($request);
if ($response->getStatusCode() !== 200) throw new RuntimeException('Home capture failed');
file_put_contents(__DIR__.'/../storage/app/private/deploy/home-source.html', $response->getContent());
echo "Home captured.\n";

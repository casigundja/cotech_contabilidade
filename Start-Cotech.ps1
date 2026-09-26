$ErrorActionPreference = 'Stop'
Set-Location -LiteralPath $PSScriptRoot
$phpExecutable = (Get-Command php -ErrorAction Stop).Source
Write-Host 'Cotech: http://127.0.0.1:8000'
Write-Host 'Painel: http://127.0.0.1:8000/login'
Write-Host 'Para encerrar, pressione Ctrl+C.'
Push-Location -LiteralPath (Join-Path $PSScriptRoot 'public')
try { & $phpExecutable -d upload_max_filesize=6M -d post_max_size=30M -S 127.0.0.1:8000 -t . ../vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php }
finally { Pop-Location }

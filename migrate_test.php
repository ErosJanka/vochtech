<?php
// migrate_test.php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Configurar o ambiente de teste manualmente
putenv('APP_ENV=testing');
putenv('DB_CONNECTION=mysql');
putenv('DB_HOST=127.0.0.1');
putenv('DB_PORT=3306');
putenv('DB_DATABASE=gestao_grupo_test');
putenv('DB_USERNAME=root');
putenv('DB_PASSWORD=');

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "🔧 Executando migrations no banco de teste...\n";
$kernel->call('migrate', ['--force' => true]);
echo "✅ Migrations concluídas!\n";

// Verificar as tabelas criadas
$db = $app->make('db');
$tables = $db->select('SHOW TABLES');
echo "📊 Tabelas criadas: " . count($tables) . "\n";
foreach ($tables as $table) {
    foreach ($table as $key => $value) {
        echo "  - $value\n";
    }
}
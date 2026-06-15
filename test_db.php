<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
try {
    $u = new App\Models\User;
    $u->name = 'Test';
    $u->email = 'test3@example.com';
    $u->password = 'abc1234';
    $u->save();
    echo 'User saved. ID: ' . $u->id . "\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

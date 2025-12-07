<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'admin@sunrays.com')->first();
$user->password = Hash::make('password'); // Reset to simple 'password'
$user->save();

echo "Password reset to 'password' for {$user->email}\n";

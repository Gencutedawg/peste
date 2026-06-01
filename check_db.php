<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\DB;

// Check users table structure
$columns = DB::select("DESCRIBE users");
echo "📋 Users Table Structure:\n";
foreach ($columns as $col) {
    echo "  - {$col->Field} ({$col->Type})\n";
}

echo "\n👥 All Users in Database:\n";
$users = User::all();
foreach ($users as $user) {
    echo "  - ID: {$user->id}\n";
    echo "    Name: {$user->name}\n";
    echo "    Email: {$user->email}\n";
    echo "    Role: {$user->role}\n\n";
}

echo "📊 Unique Roles:\n";
$roles = User::distinct('role')->get(['role']);
foreach ($roles as $role) {
    $count = User::where('role', $role->role)->count();
    echo "  - {$role->role} ({$count} users)\n";
}

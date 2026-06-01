<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Check if admin user exists
$adminExists = User::where('email', 'admin@example.com')->exists();
if (!$adminExists) {
    User::create([
        'first_name' => 'Admin',
        'last_name' => 'User',
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'email_verified_at' => now(),
    ]);
    echo "✓ Admin user created successfully!\n";
    echo "  Email: admin@example.com\n";
    echo "  Password: password\n";
} else {
    echo "✓ Admin user already exists!\n";
}

// List all users
$users = User::all();
echo "\n📋 Total users in database: " . count($users) . "\n";
foreach ($users as $user) {
    echo "  - {$user->name} ({$user->email}) - Role: {$user->role}\n";
}

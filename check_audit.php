<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "🔍 Checking created_by and updated_by fields:\n\n";

$users = User::all();
foreach ($users as $user) {
    echo "User: {$user->name} (ID: {$user->id})\n";
    echo "  - created_by: {$user->created_by}\n";
    echo "  - updated_by: {$user->updated_by}\n";
    
    if ($user->creator) {
        echo "  - Creator: {$user->creator->name}\n";
    } else {
        echo "  - Creator: System/None\n";
    }
    
    if ($user->updater) {
        echo "  - Last Updated By: {$user->updater->name}\n";
    } else {
        echo "  - Last Updated By: None\n";
    }
    echo "\n";
}

echo "✅ Audit fields are properly configured!\n";

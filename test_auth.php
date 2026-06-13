<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$kredensial = ['user_name' => 'marangga158', 'password' => '123456'];
if (Illuminate\Support\Facades\Auth::attempt($kredensial)) {
    echo "Login Berhasil\n";
} else {
    echo "Login Gagal\n";
}
$u = App\Models\User::where('user_name', 'marangga158')->first();
if ($u) {
    echo "Hash in DB: " . $u->password . "\n";
    echo "Hash Check: " . (Illuminate\Support\Facades\Hash::check('123456', $u->password) ? 'Match' : 'Mismatch') . "\n";
} else {
    echo "User not found\n";
}

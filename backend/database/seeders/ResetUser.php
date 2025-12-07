<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ResetUser extends Seeder
{
    public function run()
    {
        $user = User::firstOrNew(['email' => 'admin@sunrays.com']);
        $user->name = 'Admin User';
        $user->password = bcrypt('password123');
        $user->save();
        $this->command->info('User updated: admin@sunrays.com / password123');
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Arya',
            'email' => 'arya@manager.com',
            'password' => Hash::make('test'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Luis',
            'email' => 'luis@logistik.com',
            'password' => Hash::make('test'),
            'role' => 'logistik',
        ]);
        
        User::create([
            'name' => 'Fajar',
            'email' => 'fajar@logistik.com',
            'password' => Hash::make('test'),
            'role' => 'logistik',
        ]);
        
        User::create([
            'name' => 'Lala',
            'email' => 'lala@perawat.com',
            'password' => Hash::make('test'),
            'role' => 'perawat',
        ]);
        
        User::create([
            'name' => 'Jihan',
            'email' => 'jihan@perawat.com',
            'password' => Hash::make('test'),
            'role' => 'perawat',
        ]);
    }
}

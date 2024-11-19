<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id'              => 1,
                'name'            => 'Admin',
                'email'           => 'admin@admin.com',
                'email_verified_at' => now(),
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
        ];

        User::insert($users);
    }
}

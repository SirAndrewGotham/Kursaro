<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //We invite you to learn our language.
        $content = [
            [
                'id' => 1,
                'is_default' => true,
                'language_id' => 37,
                'title' => 'Learn Esperanto',
                'content' => 'We invite you to learn our language.',
                'is_active' =>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'is_default' => false,
                'language_id' => 42,
                'title' => 'Lernu Esperanton',
                'content' => 'Ni invitas vin lerni nian lingvon.',
                'is_active' =>true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Home::insert($content);
    }
}

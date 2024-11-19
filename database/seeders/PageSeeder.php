<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'id' => 1,
                'page_id' => null,
                'language_id' => 37,
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => 'Our privacy policy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'page_id' => null,
                'language_id' => 37,
                'title' => 'Legal Notice',
                'slug' => 'legal-notice',
                'content' => 'Our privacy policy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'page_id' => null,
                'language_id' => 37,
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'content' => 'Our privacy policy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'page_id' => 1,
                'language_id' => 42,
                'title' => 'Privateca Politiko',
                'slug' => 'privateca-politiko',
                'content' => 'Nia Privateca Politiko',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'page_id' => 2,
                'language_id' => 42,
                'title' => 'Leĝa Avizo',
                'slug' => 'lega-avizo',
                'content' => 'Nia Leĝa Avizo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'page_id' => 3,
                'language_id' => 42,
                'title' => 'Servokondiĉoj',
                'slug' => 'servokondicoj',
                'content' => 'Niaj Servokondiĉoj',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Page::insert($pages);
    }
}

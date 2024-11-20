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
                'page_id' => null,
                'language_id' => 37,
                'title' => 'About',
                'slug' => 'about',
                'content' => 'About our project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'page_id' => null,
                'language_id' => 37,
                'title' => 'Testimonials',
                'slug' => 'testimonials',
                'content' => 'Some testimonials',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'page_id' => null,
                'language_id' => 37,
                'title' => 'Features',
                'slug' => 'features',
                'content' => 'Features of the KURSARO system',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'page_id' => null,
                'language_id' => 37,
                'title' => 'How it works',
                'slug' => 'how-it-works',
                'content' => 'Brief description of the system functionality',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'page_id' => 1,
                'language_id' => 42,
                'title' => 'Privateca Politiko',
                'slug' => 'privateca-politiko',
                'content' => 'Nia Privateca Politiko',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'page_id' => 2,
                'language_id' => 42,
                'title' => 'Leĝa Avizo',
                'slug' => 'lega-avizo',
                'content' => 'Nia Leĝa Avizo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'page_id' => 3,
                'language_id' => 42,
                'title' => 'Servokondiĉoj',
                'slug' => 'servokondicoj',
                'content' => 'Niaj Servokondiĉoj',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'page_id' => 4,
                'language_id' => 42,
                'title' => 'Pri la projekto',
                'slug' => 'pri-la-projekto',
                'content' => 'Informoj pri la projekto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'page_id' => 5,
                'language_id' => 42,
                'title' => 'Atestoj',
                'slug' => 'atestoj',
                'content' => 'Atestoj de kelkaj vizitantoj',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'page_id' => 6,
                'language_id' => 42,
                'title' => 'Karakterizaĵoj',
                'slug' => 'karakterizajxoj',
                'content' => 'Kiuj karakteristikoj havas la sistemo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'page_id' => 7,
                'language_id' => 42,
                'title' => 'Kiel sistemo funkcias',
                'slug' => 'kiel-sistemo-funkcias',
                'content' => 'Priskribo pri kiel la sistemo funkcias',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Page::insert($pages);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Teknologi',
                'slug' => Str::slug('Teknologi'),
                'description' => 'Kategori untuk artikel dan berita seputar teknologi.',
            ],
            [
                'name' => 'Olahraga',
                'slug' => Str::slug('Olahraga'),
                'description' => 'Kategori untuk informasi dan berita olahraga.',
            ],
            [
                'name' => 'Lifestyle',
                'slug' => Str::slug('Lifestyle'),
                'description' => 'Kategori tentang gaya hidup, tips, dan tren terbaru.',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}

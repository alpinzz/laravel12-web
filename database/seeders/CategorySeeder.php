<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Artikel',
            // 'slug' => 'artikel'
        ]);

        Category::create([
            'name' => 'Kegiatan',
            // 'slug' => 'kegiatan'
        ]);

        Category::create([
            'name' => 'Islam dan Ke-Muhammadiyahan',
            // 'slug' => 'islam-kemuhammadiyahan'
        ]);
    }
}

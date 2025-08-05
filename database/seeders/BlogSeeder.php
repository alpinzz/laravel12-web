<?php

namespace Database\Seeders;

use App\Models\Blogs;
use Illuminate\Database\Seeder;



class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blogs::factory()->count(40)->create();
    }
}

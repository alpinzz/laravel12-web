<?php

namespace Database\Factories;

use App\Models\Blogs;
use App\Models\Category;
use App\Models\Divisi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blogs>
 */
class BlogsFactory extends Factory
{
    protected $model = Blogs::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'image' => null,
            'content' => $this->faker->paragraphs(3, true),
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'divisi_id' => Divisi::inRandomOrder()->first()->id ?? 1
        ];
    }
}

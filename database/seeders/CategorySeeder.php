<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Comunicación',
                'slug' => Str::slug('Comunicación'),
                'icon' => '<i class="fas fa-book-open"></i>'
            ],
            [
                'name' => 'Matematica',
                'slug' => Str::slug('Matematica'),
                'icon' => '<i class="fas fa-calculator"></i>'
            ],
            [
                'name' => 'Historia, Geografia y Economía',
                'slug' => Str::slug('Historia, Geografia y Economía'),
                'icon' => '<i class="fas fa-globe"></i>'
            ],
            [
                'name' => 'Desarrollo Personal, Ciudadanía y Cívica',
                'slug' => Str::slug('Desarrollo Personal, Ciudadanía y Cívica'),
                'icon' => '<i class="fas fa-traffic-light"></i>'
            ],
        ];
        foreach ($categories as $category) {
            Category::factory(1)->create($category);
        }

    }
}

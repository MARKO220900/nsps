<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            //Comunicación
                [
                    'category_id' => 1,
                    'name' => 'Cuadernos de Trabajo',
                    'slug' => Str::slug('Cuadernos de Trabajo'),
                    'grade' => true
                ], 
                [
                    'category_id' => 1,
                    'name' => 'Textos Literarios',
                    'slug' => Str::slug('Textos Literarios'),
                ], 
                [
                    'category_id' => 1,
                    'name' => 'Coherencia y Cohesión',
                    'slug' => Str::slug('Coherencia y Cohesión'),
                ], 
            //Matematica
                [
                    'category_id' => 2,
                    'name' => 'Cuadernos de Trabajo',
                    'slug' => Str::slug('Cuadernos de Trabajo'),
                    'grade' => true
                ],
                [
                    'category_id' => 2,
                    'name' => 'Razonamiento Matemático',
                    'slug' => Str::slug('Razonamiento Matemático'),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Textos Informativos',
                    'slug' => Str::slug('Textos Informativos'),
                ],
            //Historia, Geografia y Economía
                [
                    'category_id' => 3,
                    'name' => 'Cuadernos de Trabajo',
                    'slug' => Str::slug('Cuadernos de Trabajo'),
                    'grade' => true
                ],
                [
                    'category_id' => 3,
                    'name' => 'Historia',
                    'slug' => Str::slug('Historia'),
                ],
                [
                    'category_id' => 3,
                    'name' => 'Geografia',
                    'slug' => Str::slug('Geografia'),
                ],
            //Desarrollo Personal, Ciudadanía y Cívica
                [
                    'category_id' => 4,
                    'name' => 'Cuadernos de Trabajo',
                    'slug' => Str::slug('Cuadernos de Trabajo'),
                    'grade' => true
                ],
                [
                    'category_id' => 4,
                    'name' => 'Desarrollo Personal',
                    'slug' => Str::slug('Desarrollo Personal'),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Civica',
                    'slug' => Str::slug('Ciudadania y civica'),
                ],
        ];
        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }
    }
}

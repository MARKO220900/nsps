<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
Use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this ->faker->sentence(5);
        $subcategory = Subcategory::all()->random();
        if ($subcategory-> grade) {
            $quantity = null;
        }else{
            $quantity = 15;
        }

        return [
            'title' => $title,
            'isbn' => $this->faker->randomElement([0, 1]),
            'isbn_number' => $this->faker->isbn13(),
            'author' => $this->faker->name(),
            'editorial' => $this->faker->company(),
            'paginas' => $this->faker->randomNumber(3),
            'año' => $this->faker->year(),
            'idioma' =>$this->faker->randomElement(['Español', 'Ingles']),   
            'slug' => Str::slug($title),
            'description' => $this->faker->text(),
            'subcategory_id' => $subcategory->id,
            'quantity' => $quantity,
            'status' => 2

        ];
    }
}

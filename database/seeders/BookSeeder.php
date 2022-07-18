<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory(36)->create()->each(function(Book $book){
            Image::factory(4)->create([
                'imagiable_id' => $book-> id,
                'imagiable_type' => Book::class
            ]);
        });
    }
}

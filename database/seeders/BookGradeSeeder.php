<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Book;

class BookGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::whereHas('subcategory', function(Builder $query){
            $query->where('grade', true);
        })->get();
        foreach ($books as $book) {
            $book->grades()->attach([
                1 => [
                    'quantity' => 10
                ],
                2 => [
                    'quantity' => 10
                ],
                3 => [
                    'quantity' => 10
                ],
                4 => [
                    'quantity' => 10
                ],
                5 => [
                    'quantity' => 10
                ]
            ]);
        }
    }
}

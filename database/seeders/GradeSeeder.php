<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;
class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = ['Primero', 'Segunto', 'Tercero', 'Cuarto', 'Quinto'];

        foreach ($grades as $grade){
            Grade::create([
                'name' => $grade
            ]);
        }
    }
}

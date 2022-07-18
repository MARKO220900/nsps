<?php

namespace App\Http\Livewire\Admin;

use App\Models\Grade;
use Livewire\Component;
use App\Models\BookGrade;

class GradeBook extends Component
{
    public $book, $grades, $grade_id, $quantity, $open = false;

    public $pivot, $pivot_grade_id, $pivot_quantity;

    protected $listeners = ['delete'];

    protected $rules = [
        'grade_id' => 'required',
        'quantity' => 'required'
    ];

    public function mount(){
        $this->grades = Grade::all();
    }
    
    public function save(){
        $this->validate();

        $pivot = BookGrade::where('grade_id', $this->grade_id)
                    ->where('book_id', $this->book->id)
                    ->first();

        if ($pivot) {
            $pivot->quantity = $pivot->quantity + $this->quantity;
            $pivot->save();

        } else {
            $this->book->grades()->attach([
                $this->grade_id => [
                    'quantity' => $this->quantity
                ]
            ]);      
        }
        $this->reset(['grade_id', 'quantity']);

        $this->emit('saved');

        $this->book = $this->book->fresh();
    }

    public function edit(BookGrade $pivot){
        $this->open=true;

        $this->pivot =$pivot;
        $this->pivot_grade_id =$pivot->grade->id;
        $this->pivot_quantity =$pivot->quantity;
    }

    public function update(){
        $this->pivot->grade_id = $this->pivot_grade_id;
        $this->pivot->quantity = $this->pivot_quantity;

        $this->pivot->save();

        $this->book = $this->book->fresh();
        $this->open = false;
    }

    public function delete(BookGrade $pivot){
        $pivot->delete();
        $this->book = $this->book->fresh();
    }

    public function render()
    {
        $book_grades = $this->book->grades;

        return view('livewire.admin.grade-book', compact('book_grades'));
    }
}

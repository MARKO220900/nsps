<div x-data>
    <p class="text-lg text-gray-700 mb-2 font-semibold">
        Grado:
    </p>
    <select wire:model="grade_id" class="form-control w-full">
        <option value="" selected disabled>Seleccionar un grado</option>
        @foreach ($grades as $grade)
            <option value="{{$grade->id}}">{{$grade->name}}</option>
        @endforeach
    </select>
    <p class="text-gray-700 my-6">
        <span class="font-semibold text-lg">Stock Disponible: </span>
        @if ($quantity)
            {{$quantity}}
        @else
            {{$book->stock}}
        @endif
    </p>
    <div class="flex">
        <div class="mr-4">
            <x-jet-secondary-button
                disabled
                x-bind:disabled="$wire.qty <=1"
                wire:loading.attr="disabled"
                wire:target="decrement"
                wire:click="decrement">
                -
            </x-jet-secondary-button>
            <span class="mx-2 text-gray-700">
                {{$qty}}
            </span>
            <x-jet-secondary-button 
                x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>
        <div class="flex-1">
            <x-button 
                x-bind:disabled="$wire.qty > $wire.quantity"
                x-bind:disabled="!$wire.quantity"
                class="w-full" 
                color="red" 
                wire:click="addItem" 
                wire:loading.attr="disabled"
                wire:target="addItem">
                Agregar a la orden
            </x-button>
        </div>
    </div>
</div>

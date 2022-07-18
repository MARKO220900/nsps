<div class="flex-1 relative" x-data>
        
    <form action="{{route('search')}}" autocomplete="off">
        <x-jet-input name="name" wire:model="search" type="text" class="w-full" placeholder="¿Estás buscando algún libro?" />

        <button class="absolute top-0 right-0 w-12 h-full bg-red-600 flex items-center justify-center rounded-r-md">
            <x-search size="42" color="white"/>
        </button>
    </form>

    <div class="absolute w-full hidden" :class="{ 'hidden' : !$wire.open }" @click.away="$wire.open = false" >
        <div class="bg-white rounded-lg shadow mt-1">
            <div class="px-4 py-3 space-y-3">
                @forelse ($books as $book)
                    <a href="{{ route('books.show', $book)}}" class="flex">
                        <img class="w-16 h-20 object-cover" src="{{Storage::url($book->images->first()->url)}}">
                        <div class="ml-4 text-gray-700">
                            <p class="text-lg font-semibold leading-5">{{$book->title}}</p>
                            <p>Categoria: {{$book->subcategory->category->name}}</p>
                        </div>
                    </a>
                @empty
                <p class="text-lg font-semibold leading-5">
                    No existe ningún registro con los parámetros específicados
                </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

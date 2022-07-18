<div>
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase">{{ $category->name }}</h1>

            <div class="grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500 w-auto">
                <i class="fas fa-border-all px-3 py-3 cursor-pointer {{ $view == 'grid' ? 'text-red-500' : ''}}" wire:click="$set('view', 'grid')"></i>
                <i class="fas fa-th-list px-3 py-3 cursor-pointer {{ $view == 'list' ? 'text-red-500' : ''}}" wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside>
            <h2 class="font-semibold text-center mb-2">Subcategorias</h2>
            <ul class="divide-y divide-gray-300">
                @foreach ($category->subcategories as $subcategory)
                    <li class="py-2 text-sm">
                        <a class="cursor-pointer hover:text-red-500 capitalize {{ $subcategoria == $subcategory->slug ? 'text-red-500 font-semibold' : '' }}" 
                            wire:click="$set('subcategoria', '{{$subcategory->slug}}')">{{ $subcategory->name }}</a>
                    </li>
                @endforeach
            </ul>
            <x-jet-button class="mt-4" wire:click="limpiar">
                Eliminar Filtro
            </x-jet-button>
        </aside>
        <div class="md:col-span-2 lg:col-span-4">

            @if ($view == 'grid')
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($books as $book)
                        <li class="bg-white rounded-lg shadow">
                            <article>
                                <figure>
                                    <img class="h-80 w-full " src="{{ Storage::url($book->images->first()->url) }}" alt="">
                                </figure>
                                <div class="py-4 px-6">
                                    <h1 class="text-lg font-semibold ">
                                        <a href="{{route('books.show', $book)}}">
                                            {{ $book->title }}
                                            {{-- {{Str::limit($book->title, 23)}} --}}
                                        </a>
                                    </h1>
                                </div>
                            </article>
                        </li>
                    @empty
                        <li class="md:col-span-2 lg:col-span-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Upss!</strong>
                                <span class="block sm:inline">No existe ningín registro con ese filtro.</span>
                            </div>
                        </li>
                        {{-- <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span> --}}
                    @endforelse
                </ul>
            @else
                <ul>
                    @forelse ($books as $book)
                        <x-book-list :book="$book"/>
                    @empty 
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Upss!</strong>
                            <span class="block sm:inline">No existe ningín registro con ese filtro.</span>
                        </div>
                    @endforelse
                </ul>
            @endif
                    
            <div class="mt-4">
                {{$books->links()}}
            </div>
        </div>
    </div>
</div>

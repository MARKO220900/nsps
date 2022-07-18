<x-app-layout>
    <div class="container py-8 ">
        <div class="grid grid-cols-5 gap-6">
            <div class="col-span-2 px-4">
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($book->images as $image)
                        <li data-thumb="{{ Storage::url($image->url)}}">
                            <img src="{{ Storage::url($image->url)}}" />
                        </li>
                        @endforeach
                    </ul>
                  </div>
            </div>
            <div class="col-span-3 ">
                <h1 class="text-3xl font-bold text-gray-700">
                    {{$book->title}}
                </h1>
                <div class="flex mt-4 mb-10">
                    <p class="text-gray-700 text-lg font-semibold">Autor: 
                        <span class="uppercase"href="">{{ $book->author }}</span>
                    </p>
                    {{-- <p class="text-gray-700 mx-10">5 
                        <i class="fas fa-star text-sm text-yellow-400"></i>
                    </p>
                    <a class="text-red-500 hover:text-red-600 underline" href="">16 reseñas</a> --}}
                </div>
                
                <div class="text-gray-700 text-lg font-semibold divide-y divide-gray-400 mb-2">
                    <p class="py-2">Categoría:  {{ $book->subcategory->category->name }} </p>
                    <p class="py-2">Sub Categoría:  {{ $book->subcategory->name }}</p>
                    @if ($book->isbn==1)
                        <p class="py-2">ISBN:  {{ $book->isbn_number}} </p>
                    @endif
                    <p class="py-2">Editorial:  {{ $book->editorial }}</p>
                    <p class="py-2">Año:  {{ $book->año }}</p>
                    <p class="py-2">Páginas:  {{ $book->paginas }}</p>
                    <p class="capitalize py-2">Idioma:    {{ $book->idioma }}</p>
                    <div class="flex py-2">
                        <p class="pr-2">Descripción: </p>
                        <p> {!! $book->description !!}</p>
                    </div>
                    <ul class="divide-y divide-gray-400"></ul>
                </div>
                
                @if ($book->subcategory->grade)
                    @livewire('add-cart-item-grade', ['book' => $book])
                @else
                    @livewire('add-cart-item', ['book' => $book])
                @endif
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>
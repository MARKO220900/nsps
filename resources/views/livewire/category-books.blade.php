<div wire:init="loadPosts">
    @if (count($books))
    
        <div class="glider-contain">
            <ul class="glider-{{$category->id}}">
            
                @foreach ($books as $book)

                    <li class="bg-white rounded-lg shadow {{ $loop->first ? '' : 'sm:ml-4' }}">
                        <article>
                            <figure>
                                <img class="h-72 w-full object-cover object-center" src="{{Storage::url($book->images->first()->url)}}" alt="">
                            </figure>
                            <div class="py-4 px-4">
                                <h1 class="text-lg font-semibold ">
                                    <a href="{{ route('books.show', $book)}}">
                                        {{$book->title}}
                                        {{-- {{Str::limit($book->title, 23)}} --}}
                                    </a>
                                </h1>
                            </div>
                        </article>
                    </li>

                @endforeach
            </ul>
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>
    @else

        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-blue-500"></div>
        </div>

    @endif
</div>

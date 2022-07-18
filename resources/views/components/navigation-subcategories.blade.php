@props(['category'])

<div class="grid grid-cols-4 px-4 py-4">
    <div>
        <p class="text-lg font-bold text-center text-gray-500 mb-3">Subcategorías</p>
        <ul>
            @foreach ($category->subcategories as $subcategory)
                <li>
                    <a href="{{route('categories.show', $category) . '?subcategoria=' . $subcategory->slug}}" class="text-gray-500 inline-block font-semibold py-1 px-4 hover:text-red-500">
                        {{$subcategory->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-span-3">
        <img class="h-64 w-full " src="{{Storage::url($category->image)}}" alt="">
    </div>
</div>
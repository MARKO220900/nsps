<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">
        Complete esta información para crear un libro
    </h1>


    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Categoria --}}
        <div>
            <x-jet-label value="CATEGORÍAS" class="font-semibold"/>
            <select class="w-full form-control" wire:model="category_id">
                <option value="" selected disabled>Seleccione una Categoría</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
            <x-jet-input-error for="category_id"/>
        </div>
        {{-- Subcategoria --}}
        <div>
            <x-jet-label value="SUBCATEGORÍAS" class="font-semibold"/>
            <select class="w-full form-control" wire:model="subcategory_id">
                <option value="" selected disabled>Seleccione una Subcategoría</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">
                        {{$subcategory->name}}
                    </option>
                @endforeach
            </select>
            <x-jet-input-error for="subcategory_id"/>
        </div>
    </div>

    {{-- Título --}}
    <div class="mb-4">
        <x-jet-label value="TÍTULO" class="font-semibold"/>
        <x-jet-input type="text" 
                    class="w-full" 
                    wire:model="title"
                    placeholder="Ingrese el título del libro"/>
        <x-jet-input-error for="title"/>
    </div>

    {{-- Slug --}}
    <div class="mb-4">
        <x-jet-label value="SLUG" class="font-semibold"/>
        <x-jet-input type="text"
                    disabled
                    class="w-full bg-gray-100" 
                    wire:model="slug"
                    placeholder="Ingrese el nombre slug del libro"/>
        <x-jet-input-error for="slug"/>
    </div>

    {{-- ISBN --}}
    <div class="mb-4">
        <div x-data="{ isbn:  @entangle('isbn') }">
            <x-jet-label value="ISBN" class="font-semibold"/>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4 cursor-pointer">
                <input x-model="isbn" type="radio" value="0" name="isbn" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    No presenta
                </span>

            </label>
            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center cursor-pointer">
                    <input x-model="isbn"  type="radio" value="1" name="isbn" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Si presenta
                    </span>

                </label>

                <div class="px-6":class="{ 'hidden': isbn != 1 }">

                    {{-- isbn --}}
                    <div>
                        <x-jet-input type="text"
                                class="w-full mb-4"
                                wire:model="isbn_number"
                                placeholder="Ingrese el ISBN del Libro"/>
                    </div>              
                </div>
            </div>
            <x-jet-input-error for="isbn_number"/>
        </div>

    </div>

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- autor --}}
        <div class="mb-4">
            <x-jet-label value="AUTOR" class="font-semibold"/>
            <x-jet-input type="text" 
                    class="w-full" 
                    wire:model="author"
                    placeholder="Ingrese el nombre del autor"/>
            <x-jet-input-error for="author"/>
        </div>
        {{-- editorial --}}
        <div class="mb-4">
            <x-jet-label value="EDITORIAL" class="font-semibold"/>
            <x-jet-input type="text" 
                    class="w-full" 
                    wire:model="editorial"
                    placeholder="Ingrese el nombre de la Editorial"/>
            <x-jet-input-error for="editorial"/>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6 mb-4">
        {{-- idioma --}}
        <div class="mb-4">
            <x-jet-label value="IDIOMA" class="font-semibold"/>
            <select class="form-control w-full" wire:model="idioma">
                <option value="" selected disabled>Seleccione el Idioma</option>
                <option value="español">Español</option>
                <option value="ingles">Inglés</option>
            </select>
            <x-jet-input-error for="idioma"/>
        </div>
        {{-- paginas --}}
        <div class="mb-4">
            <x-jet-label value="PÁGINAS" class="font-semibold"/>
            <x-jet-input type="number" 
                    class="w-full" 
                    wire:model="paginas"
                    placeholder="Ingrese el número de Páginas"/>
            <x-jet-input-error for="editorial"/>
        </div>
        {{-- año --}}
        <div class="mb-4">
            <x-jet-label value="AÑO" class="font-semibold"/>
            <x-jet-input type="number" 
                    class="w-full" 
                    min="1900"
                    max="2022"
                    wire:model="año"
                    placeholder="Ingrese el año del libro"/>
            <x-jet-input-error for="editorial"/>
        </div>
    </div>

    {{-- Descripcion --}}
    <div class="mb-4" >
        <div wire:ignore>
            <x-jet-label value="DESCRIPCIÓN" class="font-semibold"/>
            <textarea class="w-full form-control" rows="5"
                wire:model="description"
                x-data 
                x-init="ClassicEditor.create($refs.miEditor)
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData())
                    })
                })
                .catch( error => {
                    console.error( error );
                } );"
                x-ref="miEditor">
            </textarea>
        </div>
        <x-jet-input-error for="description"/>
    </div>

    @if ($subcategory_id)
        @if (!$this->subcategory->grade)
        <div class="mb-4">
            <x-jet-label value="CANTIDAD" class="font-semibold"/>
            <x-jet-input type="number"
                        wire:model="quantity"
                        class="w-full"/>
            <x-jet-input-error for="quantity"/>
        </div>
        @endif
    @endif

    <div class="flex">
        <x-jet-button class="ml-auto" 
                    wire:loading.attr="disabled"
                    wire:target="save"
                    wire:click="save">
            Crear Libro
        </x-jet-button>
    </div>
    
</div>

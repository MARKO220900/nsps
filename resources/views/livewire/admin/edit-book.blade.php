<div>

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Libros
                </h1>
                <x-jet-danger-button wire:click="$emit('deleteBook')">
                    Eliminar
                </x-jet-danger-button>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-8">
            Editar Libro
        </h1>
    
        <div class="mb-4" wire:ignore>
            <form action="{{ route('admin.books.files', $book) }}" 
                method="POST" 
                class="dropzone"
                id="my-awesome-dropzone"></form>
        </div>
    
        @if ($book->images->count())
    
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del libro</h1>
                <ul class="flex flex-wrap">
                    @foreach ($book->images as $image)
                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img class="w-28 h-40 object-cover" src="{{ Storage::url($image->url) }}" alt="">
                            <x-jet-danger-button class="absolute right-2 top-2"
                                wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                wire:target="deleteImage({{ $image->id }})">
                                <i class="fas fa-trash"></i>
                            </x-jet-danger-button>
                        </li>
                    @endforeach
                    </ul>
            </section>
    
        @endif
    
        @livewire('admin.status-book', ['book' => $book], key('status-book-' . $book->id))
        <div class="bg-white shadow-xl rounded-lg p-6">
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
                    <x-jet-input-error for="book.category_id"/>
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
                            wire:model="book.title"
                            placeholder="Ingrese el título del libro"/>
                <x-jet-input-error for="book.title"/>
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
                            wire:model="book.author"
                            placeholder="Ingrese el nombre del Autor"/>
                    <x-jet-input-error for="book.author"/>
                </div>
                {{-- editorial --}}
                <div class="mb-4">
                    <x-jet-label value="EDITORIAL" class="font-semibold"/>
                    <x-jet-input type="text" 
                            class="w-full" 
                            wire:model="book.editorial"
                            placeholder="Ingrese el nombre de la Editorial"/>
                    <x-jet-input-error for="book.editorial"/>
                </div>
            </div>
    
            <div class="grid grid-cols-3 gap-6 mb-4">
                {{-- idioma --}}
                <div class="mb-4">
                    <x-jet-label value="IDIOMA" class="font-semibold"/>
                    <select class="form-control w-full" wire:model="book.idioma">
                        <option value="" selected disabled>Seleccione el Idioma</option>
                        <option value="español">Español</option>
                        <option value="ingles">Inglés</option>
                    </select>
                    <x-jet-input-error for="book.idioma"/>
                </div>
                {{-- paginas --}}
                <div class="mb-4">
                    <x-jet-label value="PÁGINAS" class="font-semibold"/>
                    <x-jet-input type="number" 
                            class="w-full" 
                            wire:model="book.paginas"
                            placeholder="Ingrese el número de Páginas"/>
                    <x-jet-input-error for="book.paginas"/>
                </div>
                {{-- año --}}
                <div class="mb-4">
                    <x-jet-label value="AÑO" class="font-semibold"/>
                    <x-jet-input type="number" 
                            class="w-full" 
                            wire:model="book.año"
                            placeholder="Ingrese el año del libro"/>
                    <x-jet-input-error for="book.año"/>
                </div>
            </div>
    
            {{-- Descripcion --}}
            <div class="mb-4" >
                <div wire:ignore>
                    <x-jet-label value="DESCRIPCIÓN" class="font-semibold"/>
                    <textarea class="w-full form-control" rows="5"
                        wire:model="book.description"
                        x-data 
                        x-init="ClassicEditor.create($refs.miEditor)
                        .then(function(editor){
                            editor.model.document.on('change:data', () => {
                                @this.set('book.description', editor.getData())
                            })
                        })
                        .catch( error => {
                            console.error( error );
                        } );"
                        x-ref="miEditor">
                    </textarea>
                </div>
                <x-jet-input-error for="book.description"/>
            </div>
    
            {{-- Cantidad --}}
            @if ($this->subcategory)
                @if (!$this->subcategory->grade)
                    <div class="mb-4">
                        <x-jet-label value="CANTIDAD" class="font-semibold"/>
                        <x-jet-input type="number"
                                    wire:model="book.quantity"
                                    class="w-full"/>
                        <x-jet-input-error for="book.quantity"/>
                    </div>
                @endif
            @endif
    
    
            <div class="flex justify-end items-center">
                <x-jet-action-message class="mr-3" on="saved">
                    Actualizado
                </x-jet-action-message>
                <x-jet-button
                            wire:loading.attr="disabled"
                            wire:target="save"
                            wire:click="save">
                    Actualizar Libro
                </x-jet-button>
            </div>
        </div>
    
        @if ($this->subcategory)
            @if ($this->subcategory->grade)
                @livewire('admin.grade-book', ['book' => $book], key('grade-color-' . $book->id))
            @endif
        @endif
    </div>

    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = { // camelized version of the `id`
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen al recuadro",
                acceptedFiles: 'image/*',
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshBook');
                }
            };
            Livewire.on('deletePivot', pivot =>{
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            Livewire.emitTo('admin.grade-book','delete', pivot);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                })
                Livewire.on('deleteBook', () => {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            Livewire.emitTo('admin.edit-book','delete');
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                })
        </script>
    @endpush 
</div>

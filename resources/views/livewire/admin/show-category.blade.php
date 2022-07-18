<div class="container py-12">
    {{-- Formulario para crear subcategoria --}}
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva subcategoría
        </x-slot>
        <x-slot name="description">
            Complete la información necesaria para crear una nueva subcategoría
        </x-slot>
        <x-slot name="form">
            {{-- nombre --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>
                <x-jet-input type="text" 
                    wire:model="createForm.name"
                    class="w-full mt-1">
                </x-jet-input>
                <x-jet-input-error for="createForm.name"/>
            </div>

            {{-- slug --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Slug
                </x-jet-label>
                <x-jet-input disabled type="text" 
                    wire:model="createForm.slug"
                    class="w-full mt-1 bg-gray-200">

                </x-jet-input>
                <x-jet-input-error for="createForm.slug"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="flex items-center">
                    <p>
                        ¿Esta subcategoría necesita especificar grado?
                    </p>
                    <div class="ml-auto">
                        <label>
                            <input wire:model.defer="createForm.grade" type="radio" value="1" name="grade">Si
                        </label>
                        <label>
                            <input wire:model.defer="createForm.grade" type="radio" value="0" name="grade">No
                        </label>
                    </div>
                </div>
                <x-jet-input-error for="createForm.grade"/>
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                Categoría creada
            </x-jet-action-message>
            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    {{-- Lista de subcategorias --}}
    <x-jet-action-section>
        <x-slot name="title">
            Lista de subcategorías
        </x-slot>

        <x-slot name="description">
            Aquí podrá observar todas las subcategorías agregadas
        </x-slot>

        <x-slot name="content">
            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full ">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td class="py-2">
                                <span class="uppercase">
                                    {{$subcategory->name}}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer"
                                        wire:click="edit('{{$subcategory->id}}')">
                                        Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer"
                                        wire:click="$emit('deleteSubategory', '{{$subcategory->id}}')">
                                        Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>

    {{-- modal para Editar --}}
    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar Subcategoría
        </x-slot>
        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <x-jet-input type="text" 
                        wire:model="editForm.name"
                        class="w-full mt-1">
                    </x-jet-input>
                    <x-jet-input-error for="editForm.name"/>
                </div>
    
                {{-- slug --}}
                <div class="">
                    <x-jet-label>
                        Slug
                    </x-jet-label>
                    <x-jet-input disabled type="text" 
                        wire:model="editForm.slug"
                        class="w-full mt-1 bg-gray-200">
    
                    </x-jet-input>
                    <x-jet-input-error for="editForm.slug"/>
                </div>

                <div>
                    <div class="flex items-center">
                        <p>
                            ¿Esta subcategoría necesita especificar grado?
                        </p>
                        <div class="ml-auto">
                            <label>
                                <input wire:model.defer="editForm.grade" type="radio" value="1" name="grade">Si
                            </label>
                            <label>
                                <input wire:model.defer="editForm.grade" type="radio" value="0" name="grade">No
                            </label>
                        </div>
                    </div>
                    <x-jet-input-error for="createForm.grade"/>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('script')
        <script>
            Livewire.on('deleteSubategory', subcategoryId => {
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
                    Livewire.emitTo('admin.show-category', 'delete', subcategoryId)
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })
            });
        </script>
    @endpush
</div>

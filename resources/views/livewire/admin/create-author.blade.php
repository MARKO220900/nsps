<div class="container py-12">
    {{-- Formaliio crear --}}
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Agregar nuevo autor
        </x-slot>

        <x-slot name="description">
            En esta sección podrá agregar un nuevo autor
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>

                <x-jet-input type="text" wire:model="name" class="w-full" />
                <x-jet-input-error for="name" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    {{-- Lista de marcas --}}
    <x-jet-action-section>
        <x-slot name="title">
            Lista de autores
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas los autores agregados
        </x-slot>

        <x-slot name="content">

            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($authors as $author)
                        <tr>
                            <td class="py-2">

                                <a class="uppercase">
                                    {{$author->name}}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$author->id}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteAuthor', '{{$author->id}}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </x-slot>
    </x-jet-action-section>

    {{-- Modal editar --}}
    <x-jet-dialog-modal wire:model="editarForm.open">
        <x-slot name="title">
            Editar autores
        </x-slot>

        <x-slot name="content">
            <x-jet-label>
                Nombre
            </x-jet-label>
            <x-jet-input wire:model="ename" type="text" class="w-full" />
            <x-jet-input-error for="ename" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('script')
        <script>
            Livewire.on('deleteAuthor', authorId => {
            
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
                        Livewire.emitTo('admin.create-author', 'delete', authorId)
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
<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">

        {{-- Grado --}}
        <div class="mb-6">
            <x-jet-label>
                Grado
            </x-jet-label>

            <div class="grid grid-cols-6 gap-6">
                @foreach ($grades as $grade)
                <label>
                    <input type="radio"
                        wire:model.defer="grade_id"
                        name="grade_id" 
                        value="{{$grade->id}}">
                    <span class="ml-2 text-gray-700 capitalize">
                        {{$grade->name}}
                    </span>
                </label>
                @endforeach
            </div>
            <x-jet-input-error for="grade_id" />
        </div>

        {{-- Cantidad --}}
        <div>
            <x-jet-label>
                Cantidad
            </x-jet-label>
            <x-jet-input type="number"
                        wire:model.defer="quantity"
                        place:holder="Ingrese una cantidad"
                        class="w-full"/>
            <x-jet-input-error for="quantity" />
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-jet-action-message class="mr-3" on="saved">
                Agregado
            </x-jet-action-message>
            <x-jet-button
                        wire:loading.attr="disabled"
                        wire:target="save"
                        wire:click="save">
                Agregar
            </x-jet-button>
        </div>
    </div>

    
    @if ($book_grades->count())
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">
                            Grado
                        </th>
                        <th class="px-4 py-2 w-1/3">
                            Cantidad
                        </th>
                        <th class="px-4 py-2 w-1/3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book_grades as $book_grade)
                        <tr wire:key="book-grade-{{$book_grade->pivot->id}}">
                            <td class="Capitalize px-8 py-2">
                                {{$grades->find($book_grade->pivot->grade_id)->name}}
                            </td>
                            <td class="px-4 py-2">
                                {{$book_grade->pivot->quantity}} unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                <x-jet-button 
                                    class="mr-2 ml-auto"
                                    wire:click="edit({{$book_grade->pivot->id}})"
                                    wire:loading.attr="disabled"
                                    wire:target="edit({{$book_grade->pivot->id}})">
                                    <i class="fas fa-edit"></i>
                                </x-jet-button>
                                <x-jet-danger-button
                                    wire:click="$emit('deletePivot', {{$book_grade->pivot->id}})">
                                    <i class="fas fa-trash"></i>
                                </x-jet-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar grados
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>
                    Grado
                </x-jet-label>
                <select class=" form-control w-full"
                        wire:model="pivot_grade_id">
                    <option value="">Seleccione un grado</option>
                    @foreach ($grades as $grade)
                        <option value="{{ucfirst($grade->id)}}">
                            {{$grade->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-jet-label>
                    Cantidad
                </x-jet-label>
                <x-jet-input class="w-full" type="number" 
                            placeholder="Ingrese una cantidad"
                            wire:model="pivot_quantity"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button
                class="ml-auto mr-2"
                wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button 
                wire:click="update"
                wire:loading.attr="disabled"
                wire:target="update">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>



<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <h1 class="text-lg font-semibold mb-6">
            CARRITO DE LA ORDEN
        </h1>
        @if (Cart::count())
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-28 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Libro
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cantidad
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                <div class="flex py-1">
                                    <img class="h-28 w-20 object-cover mr-7" src="{{ $item->options->image }}" alt="">
                                    <div class="justify-center">
                                        <p class="font-bold text-lg">{{$item->name}}</p>
                                        @if ($item->options->grade)
                                            <span>
                                                Grado: {{($item->options->grade)}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    @if ($item->options->grade)
                                        @livewire('update-cart-item-grade', ['rowId' => $item->rowId], key($item->rowId))
                                    @else
                                        @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                    @endif
                                </div>
                            </td>
                            <td class="px-2">
                                <a class="cursor-pointer hover:text-red-600"
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:tarjet="delete('{{$item->rowId}}')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4">
                <a class="text-gray-700 hover:text-gray-400 hover:underline cursor-pointer mt-3 font-semibold inline-block" 
                    wire:click="destroy">
                <i class="fas fa-trash">
                    Vaciar Carrito
                </i>
            </a>
            </div>
        @else
            <div class="flex flex-col items-center">
                <x-cart color="red">
                </x-cart>
                <p class="text-lg text-gray-700 mt-4">
                    TU ORDEN ESTÁ VACÍA
                </p>
                <x-button-enlace href="/" class="mt-4 px-16">
                    Ir al Inicio
                </x-button-enlace>
            </div>
        @endif
    </section>
    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-end">
                <div>
                    <x-button-enlace 
                        wire:loading.attr="disabled"
                        wire:target="created_order"
                        wire:click="create_order">
                        Solicitar préstamo
                    </x-button-enlace>
                </div>
            </div>
        </div>
    @endif
</div>

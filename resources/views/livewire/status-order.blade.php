<div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">
            @if ($order->status == 7)
                <div class="relative">
                    <div class="{{ ($order->status >= 1) ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-12 w-12 flex items-center justify-center">
                        <i class="fas fa-check text-white"></i>
                    </div>

                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Pendiente</p>
                    </div>
                </div>

                <div class="{{ ($order->status == 7) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

                <div class="relative">
                    <div class="{{ ($order->status == 7) ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-12 w-12 flex items-center justify-center">
                        <i class="fas fa-times-circle text-white"></i>
                    </div>

                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Rechazada</p>
                    </div>
                </div>
            @else
                <div class="relative">
                    <div class="{{ ($order->status >= 1 && $order->status != 7) ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-12 w-12 flex items-center justify-center">
                        <i class="fas fa-check text-white"></i>
                    </div>

                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Pendiente</p>
                    </div>
                </div>

                <div class="{{ ($order->status >= 2 && $order->status != 7) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

                <div class="relative">
                    <div class="{{ ($order->status >= 2 && $order->status != 7) ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-12 w-12 flex items-center justify-center">
                        <i class="fas fa-check text-white"></i>
                    </div>

                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Aceptado</p>
                    </div>
                </div>

                <div class="{{ ($order->status >= 3 && $order->status != 7) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

                <div class="relative">
                    <div class="{{ ($order->status >= 3 && $order->status != 7) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                        <i class="fas fa-check text-white"></i>
                    </div>

                    <div class="absolute -left-1 mt-0.5">
                        <p>Entregado</p>
                    </div>
                </div>

                <div class="{{ ($order->status >= 5 && $order->status != 7) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

                <div class="relative">
                    <div class="{{ ($order->status >= 5 && $order->status != 7) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                        <i class="fas fa-check text-white"></i>
                    </div>

                    <div class="absolute -left-2 mt-0.5">
                        <p>Devuelto</p>
                    </div>
                </div>    
            @endif
            
        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <p class="text-gray-700 uppercase">
                <span class="font-bold">
                    Número de préstamo:
                </span>
                Préstamo-{{ $order->id }}
            </p>
            <form wire:submit.prevent="update">
                <div class="flex space-x-3 mt-2">
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="1" class="mr-2">
                            PENDIENTE
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="2" class="mr-2">
                            ACEPTADO
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="3" class="mr-2">
                            ENTREGADO
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="5" class="mr-2">
                            DEVUELTO
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="7" class="mr-2">
                            RECHAZADO
                    </x-jet-label>
                </div>
                <div class="flex mt-2">
                    <x-jet-button class="ml-auto">
                        Actualizar
                    </x-jet-button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <p class="text-gray-700 uppercase mt-2">
                <span class="font-bold">
                    Nombre del usuario:
                </span>
                <span> {{$order->user->name}}</span>
            </p>            
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-4">Resumen</p>

            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Cantidad</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex mt-1">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                        alt="">
                                    <article>
                                        <h1 class="font-bold text-lg">{{ $item->name }}</h1>
                                        <div class="flex text-sm">
                                            @isset($item->options->grade)
                                                Grado: {{ __($item->options->grade) }}
                                            @endisset
                                        </div>
                                    </article>
                                </div>
                            </td>
                            <td class="text-center">
                                {{ $item->qty }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

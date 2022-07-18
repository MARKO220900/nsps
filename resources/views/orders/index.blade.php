<x-app-layout>
    <div class="container py-12">
        <section class="grid grid-cols-5 gap-6 text-white">
            <a href="{{route('orders.index') . "?status=1"}}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$pendiente}}
                </p>
                <p class="uppercase text-2xl">Pendiente</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-business-time"></i>
                </p>
            </a>
            <a href="{{route('orders.index') . "?status=2"}}" class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$aceptado}}
                </p>
                <p class="uppercase text-2xl">Aceptado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>
            <a href="{{route('orders.index') . "?status=3"}}" class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$entregado}}
                </p>
                <p class="uppercase text-2xl">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-bookmark"></i>
                </p>
            </a>
            <a href="{{route('orders.index') . "?status=5"}}" class="bg-pink-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$devuelto}}
                </p>
                <p class="uppercase text-2xl">Devuelto</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-retweet"></i>
                </p>
            </a>
            <a href="{{route('orders.index') . "?status=7"}}" class="bg-green-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$rechazado}}
                </p>
                <p class="uppercase text-2xl">Rechazado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        @if ($orders->count())
            <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <h1 class="text-2xl mb-4">Préstamos Recientes</h1>
                
                <ul>
                    @foreach ($orders as $order)
                        <li >
                            <a href="{{route('orders.show', $order)}}" class="flex items-center py-2 px-4 hover:bg-gray-100">
                                <span class="w-12 text-center">
                                    @switch($order->status)
                                        @case(1)
                                            <i class="fas fa-business-time text-red-500 opacity-50"></i>
                                            @break
                                        @case(2)
                                            <i class="fas fa-check-circle text-gray-500 opacity-50"></i>
                                            @break
                                        @case(3)
                                            <i class="fas fa-bookmark text-yellow-500 opacity-50"></i>
                                            @break
                                        @case(5)
                                            <i class="fas fa-retweet text-pink-500 opacity-50"></i>                                        
                                            @break
                                        @case(7)
                                            <i class="fas fa-times-circle text-green-500 opacity-50"></i>
                                            @break
                                        @default
                                            
                                    @endswitch
                                </span>

                                <span>
                                    Order: {{$order->id}}
                                    <br>
                                    {{$order->created_at->format('d/m/y')}}
                                </span>

                                <div class="ml-auto">
                                    <span class="font-bold">
                                        @switch($order->status)
                                            @case(1)
                                                Pendiente
                                                @break
                                            @case(2)
                                                Aceptado
                                                @break
                                            @case(3)
                                                Entregado
                                                @break
                                            @case(5)
                                                Devuelto
                                                @break
                                            @case(7)
                                                Rechazado
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </span>
                                </div>
                                <span>
                                    <i class="fas fa-angle-right ml-8"></i>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @else
            <div class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <span class="font-bold text-lg">
                    No existe registro de ordenes
                </span>
            </div>
        @endif
    </div>
</x-app-layout>
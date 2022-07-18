<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Usuarios
            </h2>

        </div>
        
    </x-slot>    
    <div class="container py-12">

        <x-table-responsive>

            <div class="px-6 py-4">
                <x-jet-input type="text" class="w-full" wire:model="search" placeholder="Escriba el usuario que desea buscar">
                </x-jet-input>
            </div>

            @if ($users->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rol
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($users as $user)

                            <tr wire:key="{{$user->email}}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-700">
                                        {{$user->id}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <div class="text-gray-700">
                                        {{$user->name}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-700">
                                        {{$user->email}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-700">
                                        @if ($user->roles->count())
                                            Admin
                                        @else
                                            No tiene Rol
                                        @endif
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <label>
                                        <input {{count($user->roles) ? 'checked' : ''}} type="radio" name="{{$user->email}}" value="1" wire:change="assignRole({{$user->id}}, $event.target.value)">
                                        Si
                                    </label>
                                    <label class="ml-2">
                                        <input {{count($user->roles) ? '' : 'checked'}} type="radio" name="{{$user->email}}" value="0" wire:change="assignRole({{$user->id}}, $event.target.value)">
                                        No
                                    </label>
                                </td>
                            </tr>

                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4 font-semibold">
                    No hay ningún usuario coincidente
                </div>
            @endif
            @if ($users->hasPages())
                <div class="px-6 py-4">
                    {{$users->links();}}
                </div>
            @endif

        </x-table-responsive>
</div>

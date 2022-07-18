<div class="bg-white shadow-lg rounded-lg p-6 mb-4">
    <p class="text-2xl text-center font-semibold mb-2">
        Estado del libro
    </p>

    <div class="flex">
        <label class="mr-6">
            <input wire:model.defer="status" type="radio" name="status" value="1">
            Marcar libro como borrador
        </label>
        <label>
            <input wire:model.defer="status" type="radio" name="status" value="2">
            Marcar libro como publicado
        </label>
    </div>

    <div class="flex justify-end items-center">
        <x-jet-action-message class="mr-3" on="saved">
            Actualizado
        </x-jet-action-message>
        <x-jet-button wire:click="save"
                    wire:loading.attr="disabled"
                    wire:target="save">
            Actualizar
        </x-jet-button>
    </div>
</div>

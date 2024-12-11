<div class="max-h-[300px] overflow-y-scroll">
    @foreach($this->products as $product)
    <x-list-item :item="$product">
        <x-slot:avatar>
        </x-slot:avatar>
        <x-slot:value>
            {{$product['name'] ?? ""}}
        </x-slot:value>
        <x-slot:sub-value>
            {{$product['barcode'] ?? ""}}
        </x-slot:sub-value>
        <x-slot:actions>
            <x-button label="Eliminar" class="btn-sm btn-secondary" wire:click="desactivate({{ $product["id"] }})" />
        </x-slot:actions>
    </x-list-item>

    @endforeach
</div>
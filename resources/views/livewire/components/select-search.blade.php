<div class="dropdown-selectsearch">
    <x-dropdown>
        <x-slot:trigger>
            <x-input hidden wire:model="idvalue" readonly />
            <x-input label="{{$this->label ?? ''}}"
                placeholder="{{$this->placeholder ?? ''}}"
                hint="{{$this->hint ?? ''}}"
                wire:model.live="value"
                readonly
                clearable />
        </x-slot:trigger>
        <x-progress wire:loading wire:target="searchvalue" class="progress-primary h-0.5" indeterminate />
        <div @click.stop="" class="p-2">
            <x-input placeholder="Buscar..." wire:model.live.debounce.300ms="searchvalue" clearable />
        </div>
        <div class="max-h-[200px] overflow-y-scroll" wire:loading wire:target="searchvalue">
            <x-menu-item class="min-w-[250px] w-[250px] max-w-[250px]" title="Cargando..." />
        </div>
        <div class="max-h-[200px] overflow-y-scroll" wire:loading.remove wire:target="searchvalue">
            @foreach ($options as $option)
            @if ($this->idvalue == $option->id)
            <x-menu-item :key="$option->id" class="text-primary min-w-[250px] w-[250px] max-w-[250px]" title="{{$option->name}}" x-on:click="$wire.idvalue = '{{$option->id}}';$wire.value = '{{$option->name}}';" />
            @else
            <x-menu-item :key="$option->id" class="min-w-[250px] w-[250px] max-w-[250px]" title="{{$option->name}}" x-on:click="$wire.idvalue = '{{$option->id}}';$wire.value = '{{$option->name}}';" />
            @endif
            @endforeach
        </div>
    </x-dropdown>
</div>
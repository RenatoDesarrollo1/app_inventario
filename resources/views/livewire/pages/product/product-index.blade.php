<div>
    <x-header class="mb-2" title="Activos" subtitle="" size="text-xl" separator>
        <x-slot:actions>
            <x-dropdown label="Acciones" class="btn-primary" right>
                <x-menu-item title="Añadir" icon="o-plus" link="/activos/create" />
            </x-dropdown>
            <x-dropdown label="Seleccionado (s) {{count($this->selected)}} elementos" class="btn-secondary" right :disabled="count($this->selected) == 0">
                <x-menu-item title="Generar etiquetas" icon="o-document" wire:click="openModalProductSelectedLabelsModal" />
                <x-menu-item title="Deseleccionar todo" icon="o-square-2-stack" wire:click="desactivate" />
            </x-dropdown>
        </x-slot:actions>
    </x-header>
    <x-table class="min-h-[500px]" :headers="$headers" :rows="$products" with-pagination per-page="perPage" :per-page-values="[20, 30, 50]" wire:model.live="selected"
        selectable>
        @scope('cell_actions', $product)
        <x-dropdown>
            <x-slot:trigger>
                <x-icon name="o-ellipsis-vertical" class="cursor-pointer" />
            </x-slot:trigger>
            <x-menu-item title="Editar" icon="o-pencil" link="/activos/edit/{{ $product->id}}" />
            <x-menu-item title="Generar etiqueta" icon="o-document" wire:click.stop="openModalProductSelectedLabelsModal('{{$product->id}}')" />
        </x-dropdown>
        @endscope
        @scope('cell_avatar', $product)
        <a href="{{asset('storage/img/products/' . $product->id . '/avatar.png')}}" target="_blank">Ver</a>
        @endscope
        @foreach ($headers as $headeritem)
        @php
        $headeritemkey = "header_" . $headeritem['key'];
        @endphp

        @if(isset($headeritem['filter']) || isset($headeritem['sort']))
        @scope($headeritemkey, $header)
        <x-popover>
            <x-slot:trigger class="w-full">
                {{ $header['label'] }}
                @if(isset($this->sort[$header['key']]))
                <div class="inline-block ms-1">
                    @switch($this->sort[$header['key']])
                    @case("ASC")
                    <x-icon name="m-arrow-small-up" />
                    @break

                    @case("DESC")
                    <x-icon name="m-arrow-small-down" />
                    @break

                    @default

                    @endswitch
                </div>
                @endif
                @if($this->filter[$header['key']]["value"] != "")
                <div class="inline-block ms-1">
                    <x-icon name="s-funnel" class="w-3 h-3" />
                </div>
                @endif
            </x-slot:trigger>
            <x-slot:content class="w-auto">
                @if (isset($header['filter']))
                <div>
                    <p class="font-normal text-sm mb-0">Filtrar</p>
                    @if($header['filter'] == "input")
                    <x-input icon="o-magnifying-glass" placeholder="Buscar..." class="my-3 input-sm font-normal" wire:model.live.debounce.250ms="filter.{{$header['key']}}.value" clearable />
                    @elseif($header['filter'] == "choices")
                    <!-- <div class="w-72">
                        <x-choices
                            class="font-normal my-3 text-sm h-fit overflow-hidden"
                            wire:model="{{$header['model']}}_ids"
                            :options="$header['options']"
                            placeholder="Buscar..."
                            search-function="{{$header['search']}}"
                            no-result-text="No hay resultados"
                            searchable />
                    </div> -->
                    @endif
                </div>
                @endif
                @if (isset($header['sort']) && $header['sort'])
                <div>
                    <p class="font-normal text-sm mb-0">Ordenar</p>
                    <x-menu class="w-full font-normal text-sm px-0">
                        <x-menu-item title="Ascendente" icon="m-arrow-small-up" class="px-2" :active="isset($this->sort[$header['key']]) && $this->sort[$header['key']] == 'ASC'" wire:click="manageSort('{{$header['key']}}', 'ASC')" />
                        <x-menu-item title="Descendente" icon="m-arrow-small-down" class="px-2" :active="isset($this->sort[$header['key']]) && $this->sort[$header['key']] == 'DESC'" wire:click="manageSort('{{$header['key']}}', 'DESC')" />
                        <x-menu-item title="Ninguno" icon="m-minus-small" class="px-2" :active="!isset($this->sort[$header['key']])" wire:click="manageSort('{{$header['key']}}', '')" />
                    </x-menu>
                </div>
                @endif
            </x-slot:content>
        </x-popover>
        @endscope
        @endif

        @endforeach
    </x-table>

    <x-modal wire:model="productSelectedLabelsModal" title="Confirmar generar etiquetas">
        <livewire:pages.product.partials.product-selected-labels lazy />
        <x-slot:actions>
            <p class="text-base font-normal mt-2">Posición (3 columnas):</p>
            <x-input type="number" inline class="input-sm font-normal" wire:model.live.debounce.250ms="position" min="1" max="3" />
            <x-button label="Cancelar" @click="closeModalProductSelectedLabelsModal" />
            <x-button label="Confirmar" class="btn-primary" wire:click="genLabels('{{$this->productid}}')" />
        </x-slot:actions>
    </x-modal>
</div>
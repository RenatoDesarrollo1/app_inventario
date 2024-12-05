<div>
    <x-header title="Activos" subtitle="" size="text-xl" separator>
        <x-slot:middle class="!justify-end">
            <x-input icon="o-magnifying-glass" placeholder="Buscar..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-document" label="Generar etiquetas" class="btn-primary" wire:click="genLabels('')" />
        </x-slot:actions>
    </x-header>
    @php
    $headers = [
    ['key' => 'actions', 'label' => ''],
    ['key' => 'barcode', 'label' => 'Código', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'name', 'label' => 'Producto', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'stateprod_name', 'label' => 'Estado', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'condition_name', 'label' => 'Condición', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'family_name', 'label' => 'Familia', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'class_name', 'label' => 'Clase', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'typeprod_name', 'label' => 'Tipo Bien', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'personnel_name', 'label' => 'Responsable', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'environment_name', 'label' => 'Ambiente', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'brand_name', 'label' => 'Marca', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'project_name', 'label' => 'Proyecto', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'adq_date', 'label' => 'Fecha adquisición', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'provider_doc', 'label' => 'RUC Proveedor', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'provider_name', 'label' => 'Proveedor', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'nro_doc', 'label' => 'Nro. Doc', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ['key' => 'amount', 'label' => 'Monto', 'class' => 'w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ];
    @endphp
    <x-table :headers="$headers" :rows="$products" with-pagination per-page="perPage" :per-page-values="[20, 30, 50]" :sort-by="$sortBy" wire:model="selected"
        selectable>
        @scope('cell_actions', $product)
        <x-dropdown>
            <x-slot:trigger>
                <x-icon name="o-ellipsis-vertical" class="cursor-pointer" />
            </x-slot:trigger>
            <x-menu-item title="Generar etiqueta" icon="o-document" wire:click.stop="genLabels('{{$product->id}}')" />
        </x-dropdown>
        @endscope
    </x-table>
</div>
<div>
    <x-form wire:submit="save">
        <div class="breadcrumbs text-sm mb-2">
            <ul>
                <li><a href="/activos">Activos</a></li>
                <li>Editar activo</li>
            </ul>
        </div>
        <x-header class="header-crud" title="Editar activo" subtitle="" size="text-xl" separator>
            <x-slot:actions>
                <x-button label="Guardar" class="btn-primary" type="submit" wire:loading.attr="disabled" />
            </x-slot:actions>
        </x-header>

        <x-errors title="Errores de validación" description="" class="text-sm mb-2" />
        <div class="max-w-[1440px] flex justify-start items-start flex-col md:flex-row gap-x-16 gap-y-8">
            <div class="w-full md:w-1/2 grid grid-cols-1 lg:grid-cols-4 gap-y-4 gap-x-8">
                <div class="lg:col-span-4 font-bold mb-1">
                    <h3>Información general</h3>
                </div>
                <div class="lg:col-span-2 row-span-3">
                    <x-file wire:model="form.file" label="Imagen" omit-error accept="image/png, image/jpeg">
                        <img src="{{asset('storage/img/products/' . $this->form->id . '/avatar.png')}}" class="h-52 rounded-lg" />
                    </x-file>
                </div>
                <div class="lg:col-span-2">
                    <x-input label="Nombre" placeholder="Nombre del producto" wire:model="form.name" clearable omit-error />
                </div>
                <div class="lg:col-span-2">
                    <x-input label="Número de documento" placeholder="Número de documento" wire:model="form.nro_doc" clearable omit-error />
                </div>
                <div class="lg:col-span-2">
                    <x-input label="Monto" placeholder="Monto del producto" wire:model="form.amount" money clearable omit-error />
                </div>
                <div class="lg:col-span-2">
                    <x-input label="Fecha de adquisición" placeholder="Fecha de adquisición" type="date" wire:model="form.adq_date" omit-error />
                </div>
                <div class="lg:col-span-2">
                    <livewire:components.select-search
                        label="Responsable"
                        placeholder="Elige un responsable"
                        wire:model.live="form.personnel_id"
                        searchevent="searchpersonnel_id"
                        :options="$personnel" />
                </div>
                <div class="lg:col-span-2">
                    <livewire:components.select-search
                        label="Ambiente"
                        placeholder="Elige un ambiente"
                        wire:model.live="form.environment_id"
                        searchevent="searchenvironments_id"
                        :options="$environments" />
                </div>
                <div class="lg:col-span-2">
                    <livewire:components.select-search
                        label="Proyecto"
                        placeholder="Elige un proyecto"
                        wire:model.live="form.project_id"
                        searchevent="searchprojects_id"
                        :options="$projects" />
                </div>
                <div class="lg:col-span-2">
                    <livewire:components.select-search
                        label="Proveedor"
                        placeholder="Elige un proveedor"
                        wire:model.live="form.provider_id"
                        searchevent="searchproviders_id"
                        :options="$providers" />
                </div>

            </div>
            <div class="w-full md:w-1/2 grid grid-cols-1 lg:grid-cols-2 gap-y-4 gap-x-8">
                <div class="lg:col-span-2 font-bold mb-1">
                    <h3>Atributos</h3>
                </div>
                <div>
                    <livewire:components.select-search
                        label="Estado"
                        placeholder="Elige un estado"
                        wire:model.live="form.state_id"
                        searchevent="searchstates_id"
                        :options="$states" />
                </div>
                <div>
                    <livewire:components.select-search
                        label="Condición"
                        placeholder="Elige una condición"
                        wire:model.live="form.condition_id"
                        searchevent="searchconditions_id"
                        :options="$conditions" />
                </div>
                <div>
                    <livewire:components.select-search
                        label="Familia"
                        placeholder="Elige una familia"
                        wire:model.live="form.family_id"
                        searchevent="searchfamilies_id"
                        :options="$families" />
                </div>
                <div>
                    <livewire:components.select-search
                        label="Clase"
                        placeholder="Elige una clase"
                        wire:model.live="form.class_id"
                        searchevent="searchclasses_id"
                        :options="$classes" />
                </div>
                <div>
                    <livewire:components.select-search
                        label="Tipo de bien"
                        placeholder="Elige un tipo de bien"
                        wire:model.live="form.type_prod_id"
                        searchevent="searchtypes_prod_id"
                        :options="$types_prod" />
                </div>
                <div>
                    <livewire:components.select-search
                        label="Marca"
                        placeholder="Elige una marca"
                        wire:model.live="form.brand_id"
                        searchevent="searchbrands_id"
                        :options="$brands" />
                </div>
            </div>
        </div>


        <div class="w-full grid grid-cols-1 gap-y-4">
            <x-textarea
                label="Descripción"
                wire:model="form.description"
                placeholder="Descripción del producto"
                hint="Máximo 1000 carácteres"
                rows="5"
                omit-error />
        </div>
    </x-form>
</div>
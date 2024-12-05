<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

{{-- The navbar with `sticky` and `full-width` --}}
<x-nav sticky full-width>

    <x-slot:brand>
        {{-- Drawer toggle for "main-drawer" --}}
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-icon name="o-bars-3" class="cursor-pointer" />
        </label>

        {{-- Brand --}}
        <div>Sistema de inventario</div>
    </x-slot:brand>

    {{-- Right side actions --}}
    <x-slot:actions>
        @if($user = auth()->user())
        <x-button label="{{$user?->username}}" icon="o-user" link="###" class="btn-ghost btn-sm" responsive />

        <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="Cerrar sesión" responsive wire:click="logout" />
        @endif
    </x-slot:actions>
</x-nav>
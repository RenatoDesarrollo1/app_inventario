<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] #[Title('Login')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>
<div class="w-[450px] max-w-[100%]">
    <x-card title="Sistema de inventario" subtitle="Cáritas del Perú" shadow separator>
        <x-form wire:submit="login">
            <x-input label="Email" placeholder="Email" icon="o-user" hint="Ingresa tu email" wire:model="form.email" clearable />
            <x-password label="Contraseña" placeholder="Contraseña" hint="Ingresa tu contraseña" wire:model="form.password" clearable />
            <x-slot:actions>
                <x-button class="btn-primary" label="Ingresar" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
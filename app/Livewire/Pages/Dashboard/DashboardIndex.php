<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Inicio')]
class DashboardIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.dashboard.dashboard-index');
    }
}

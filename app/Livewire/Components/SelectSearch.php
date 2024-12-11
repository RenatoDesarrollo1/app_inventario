<?php

namespace App\Livewire\Components;

use Illuminate\Support\Collection;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SelectSearch extends Component
{

    public string $label = '';
    public string $placeholder = '';
    public string $hint = '';
    public int $take = 10;

    #[Modelable]
    public $idvalue = '';
    public $value = '';
    public string $searchevent = '';
    public string $searchvalue = '';


    #[Reactive]
    public Collection|array $options;


    public function mount()
    {
        if ($this->idvalue != "") {
            $this->value = $this->options->where('id', $this->idvalue)->pluck("name")->first();
        }
    }

    public function updating($property, $value)
    {
        if ($property == "value") {
            if ($value == "") {
                $this->idvalue = null;
            }
            $this->searchvalue = "";
            $this->dispatch($this->searchevent, value: $this->searchvalue, take: $this->take);
        }
    }

    public function updatedSearchvalue()
    {
        $this->dispatch($this->searchevent, value: $this->searchvalue, take: $this->take);
    }



    public function render()
    {
        return view('livewire.components.select-search');
    }
}

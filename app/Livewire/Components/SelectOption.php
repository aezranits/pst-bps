<?php

namespace App\Livewire\Components;

use App\Models\Province;
use App\Models\Regency;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SelectOption extends Component
{
    #[Modelable]
    public $value = null;

    public $name;

    #[Reactive]
    public $options;

    public function mount ($name, $options){
        $this->name = $name;
        $this->options = $options;
        $this->options->ensure([Province::class, Regency::class]);
    }

    public function render()
    {
        return view('livewire.components.select-option');
    }
}

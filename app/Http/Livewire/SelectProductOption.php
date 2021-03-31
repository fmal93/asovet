<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectProductOption extends Component
{
    public $option;
    
    public function render()
    {
        return view('livewire.select-product-option');
    }
}

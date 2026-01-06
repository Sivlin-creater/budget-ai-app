<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title("History - ExpenseApp")]
class History extends Component
{
    public string $tab = 'budget';

    public function setTab(string $tab){
        $this->tab = $tab;
    }
    
    public function render()
    {
        return view('livewire.history');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CategoryHistory;

class CategoriesHistory extends Component
{

    public $listeners = ['historyUploaded' => '$refresh'];

    public function render()
    {

        $history = CategoryHistory::latest()
            ->take(50)
            ->get();

        return view('livewire.categories-history', [
            'history' => $history
        ]);
    }
}

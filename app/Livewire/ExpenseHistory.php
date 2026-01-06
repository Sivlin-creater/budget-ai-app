<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title("Expense History - ExpenseApp")]
class ExpenseHistory extends Component
{

    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $startDate;
    public $endDate;

    protected $queryString = [
        'search',
        'selectedCategory',
        'startDate',
        'endDate',
    ];

    public function render()
    {
        $expenses = Expense::with('category')
            ->where('user_id', Auth::id())
            ->when($this->search, fn ($q) =>
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
            )
            ->when($this->selectedCategory, fn ($q) =>
                $q->where('category_id', $this->selectedCategory)
            )
            ->when($this->startDate, fn ($q) =>
                $q->whereDate('date', '>=', $this->startDate)
            )
            ->when($this->endDate, fn ($q) =>
                $q->whereDate('date', '<=', $this->endDate)
            )
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('livewire.expense-history', [
            'expenses' => $expenses,
            'categories' => Category::where('user_id', Auth::id())->get(),
            'total' => $expenses->sum('amount'),
        ]);
    }
}

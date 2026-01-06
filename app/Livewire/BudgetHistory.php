<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Title("Budget History - ExpenseApp")]
class BudgetHistory extends Component
{
    #[Computed]
    public function budgetHistory()
    {
        return Budget::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($budget) {
                $budget->spent = $budget->getSpentAmount();
                $budget->remaining = $budget->getRemainingAmount();
                $budget->percentage = $budget->getPercentageUsed();
                $budget->is_over = $budget->isOverBudget();
                return $budget;
            });
    }

    public function render()
    {
        return view('livewire.budget-history');
    }
}

<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Models\Budget;
use App\Livewire\Categories;
use App\Livewire\BudgetList;
use App\Livewire\BudgetForm;
use App\Livewire\ExpenseForm;
use App\Livewire\ExpenseList;
use App\Livewire\RecurringExpense; 
use App\Livewire\Dashboard;
use App\Livewire\BudgetHistory;
use App\Livewire\ExpenseHistory;
use App\Livewire\History;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('categories', Categories::class)->name('categories.index');
    Route::get('budgets', BudgetList::class)->name('budgets.index');
    Route::get('budgets/create', BudgetForm::class)->name('budget.create');
    Route::get('budgets/{budgetId}/edit', BudgetForm::class)->name('budgtes.edit');

    //expenses
    Route::get('expenses', ExpenseList::class)->name('expenses.index');
    Route::get('/expenses/create',ExpenseForm::class)->name('expenses.create');
    Route::get('expenses/{expenseId}/edit',ExpenseForm::class)->name('expenses.edit');
    Route::get('recurring-expenses',RecurringExpense::class)->name('recurring-expenses.index');

    //History
    Route::get('/history', History::class)->name('history');

    // Route::get('/categories/history', \App\Livewire\CategoriesHistory::class)
    // ->name('categories.history');
    // Route::get('/budget-history', BudgetHistory::class)->name('budget.history');
    // Route::get('/expenses/history', ExpenseHistory::class)
    // ->name('expense.history')
    // ->middleware('auth');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');



    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

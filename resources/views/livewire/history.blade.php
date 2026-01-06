<div class="min-h-screen bg-rose-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-600 to-rose-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <h1 class="text-3xl font-bold text-white">History</h1>
            <p class="text-rose-100">View all historical data</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- Tabs -->
<div class="flex gap-2 mb-6 border-b border-gray-200">
    <button wire:click="setTab('budget')"
        class="px-4 py-2 font-medium rounded-t-lg transition
        {{ $tab === 'budget'
            ? 'bg-rose-600 text-white border-t border-l border-r border-rose-600'
            : 'bg-white text-gray-700 hover:bg-rose-100 border border-gray-200' }}">
        Budget History
    </button>

    <button wire:click="setTab('expense')"
        class="px-4 py-2 font-medium rounded-t-lg transition
        {{ $tab === 'expense'
            ? 'bg-rose-600 text-white border-t border-l border-r border-rose-600'
            : 'bg-white text-gray-700 hover:bg-rose-100 border border-gray-200' }}">
        Expense History
    </button>

    <button wire:click="setTab('category')"
        class="px-4 py-2 font-medium rounded-t-lg transition
        {{ $tab === 'category'
            ? 'bg-rose-600 text-white border-t border-l border-r border-rose-600'
            : 'bg-white text-gray-700 hover:bg-rose-100 border border-gray-200' }}">
        Category History
    </button>
</div>

<!-- Content -->
<div class="bg-white rounded-b-xl shadow-md p-4 border border-gray-200">
    @if ($tab === 'budget')
        <livewire:budget-history />
    @elseif ($tab === 'expense')
        <livewire:expense-history />
    @elseif ($tab === 'category')
        <livewire:categories-history />
    @endif
</div>


    </div>
</div>

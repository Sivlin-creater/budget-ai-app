<div class="min-h-screen bg-rose-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-600 to-rose-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div>
                <!-- <h1 class="text-3xl font-bold text-white">Expense History</h1> -->
                <p class="text-rose-100 mt-1">View all your past expenses</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6 border-t-4 border-pink-600">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text"
                           wire:model.live.debounce.300ms="search"
                           placeholder="Search expenses..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500">
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select wire:model.live="selectedCategory"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Start Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                    <input type="date"
                           wire:model.live="startDate"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500">
                </div>

                <!-- End Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                    <input type="date"
                           wire:model.live="endDate"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500">
                </div>

            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-pink-600">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-rose-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($expenses as $expense)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $expense->date->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $expense->date->format('l') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if($expense->category)
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium"
                                              style="background-color: {{ $expense->category->color }}20; color: {{ $expense->category->color }};">
                                            <span class="w-2 h-2 rounded-full"
                                                  style="background-color: {{ $expense->category->color }};"></span>
                                            {{ $expense->category->name }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">Uncategorized</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $expense->title }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs truncate">
                                        {{ $expense->description ?: '—' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="text-sm font-bold text-gray-900">
                                        ${{ number_format($expense->amount, 2) }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <p class="text-gray-600">No expense history found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($expenses->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $expenses->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

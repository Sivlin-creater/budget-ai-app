<div wire:poll.5s class="min-h-screen bg-white dark:bg-zinc-800 p-6">
    <!-- <h2 class="text-xl font-bold mb-4">Budget History</h2> -->

    @if($this->budgetHistory->count() > 0)
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="p-2 text-left">Month/Year</th>
                        <th class="p-2 text-left">Category</th>
                        <th class="p-2 text-right">Amount</th>
                        <th class="p-2 text-right">Spent</th>
                        <th class="p-2 text-right">Remaining</th>
                        <th class="p-2 text-right">Used %</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->budgetHistory as $budget)
                        <tr class="border-t border-gray-200 dark:border-gray-700 {{ $budget->is_over ? 'bg-red-100 dark:bg-red-900' : '' }}">
                            <td class="p-2">{{ \Carbon\Carbon::create($budget->year, $budget->month)->format('F Y') }}</td>
                            <td class="p-2">{{ $budget->category->name ?? 'N/A' }}</td>
                            <td class="p-2 text-right">{{ number_format($budget->amount, 2) }}</td>
                            <td class="p-2 text-right">{{ number_format($budget->spent, 2) }}</td>
                            <td class="p-2 text-right">{{ number_format($budget->remaining, 2) }}</td>
                            <td class="p-2 text-right">{{ $budget->percentage }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-400 dark:text-gray-500">No budget history yet.</p>
    @endif
</div>

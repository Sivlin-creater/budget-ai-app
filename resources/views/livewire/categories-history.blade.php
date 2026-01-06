<div wire:poll.5s>
    <div class="min-h-screen bg-white dark:bg-zinc-800 p-6">
        <!-- <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Category History</h1> -->

        @if($history->count() > 0)
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow overflow-hidden">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($history as $item)
                        <li class="px-6 py-4 flex justify-between items-center">
                            <div class="text-gray-700 dark:text-gray-300 text-sm">
                                {{ ucfirst($item->action) }} category 
                                {{ $item->details ? '('.json_decode($item->details)->name.')' : '' }}
                            </div>
                            <div class="text-gray-400 text-xs">
                                {{ $item->created_at->diffForHumans() }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-gray-400 dark:text-gray-500">No category history yet.</p>
        @endif
    </div>

</div>
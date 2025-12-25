<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎫 All Tickets (Admin)
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">

                @foreach($tickets as $ticket)
                    <div class="bg-white shadow-md rounded-2xl p-6">
                        <!-- Ticket Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $ticket->title }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    User: {{ $ticket->user->email }}
                                </p>
                            </div>

                            <!-- Status Badge -->
                            <span class="
                                px-3 py-1 text-xs font-semibold rounded-full
                                @if($ticket->status === 'open') bg-blue-100 text-blue-700
                                @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-700
                                @else bg-green-100 text-green-700
                                @endif
                            ">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </div>

                        <!-- Priority -->
                        <p class="text-sm mb-4">
                            <span class="font-medium text-gray-700">Priority:</span>
                            <span class="
                                ml-2 px-2 py-1 text-xs rounded
                                @if($ticket->priority === 'low') bg-gray-100 text-gray-700
                                @elseif($ticket->priority === 'medium') bg-indigo-100 text-indigo-700
                                @else bg-red-100 text-red-700
                                @endif
                            ">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </p>

                        <!-- Update Form -->
                        <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="flex flex-wrap gap-4 items-center">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                                <select name="status" class="rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="open" @selected($ticket->status === 'open')>Open</option>
                                    <option value="in_progress" @selected($ticket->status === 'in_progress')>In Progress</option>
                                    <option value="closed" @selected($ticket->status === 'closed')>Closed</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Priority</label>
                                <select name="priority" class="rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="low" @selected($ticket->priority === 'low')>Low</option>
                                    <option value="medium" @selected($ticket->priority === 'medium')>Medium</option>
                                    <option value="high" @selected($ticket->priority === 'high')>High</option>
                                </select>
                            </div>

                            <div class="mt-4 sm:mt-0">
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-5 py-2 mt-4 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition"
                                >
                                    💾 Update
                                </button>
                            </div>
                        </form>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>

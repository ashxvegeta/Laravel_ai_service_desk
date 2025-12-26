<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎫 Support Tickets
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- ================= CREATE TICKET ================= -->
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">
                        Submit a New Ticket
                    </h3>

                    <form method="POST" action="{{ route('tickets.store') }}" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Ticket Title
                            </label>
                            <input
                                type="text"
                                name="title"
                                placeholder="e.g. Unable to login"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Description
                            </label>
                            <textarea
                                name="description"
                                rows="5"
                                placeholder="Describe your issue in detail..."
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            ></textarea>
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="inline-flex items-center px-6 py-2 bg-indigo-600 rounded-lg font-semibold text-white hover:bg-indigo-700 transition"
                            >
                                🚀 Submit Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ================= MY TICKETS ================= -->
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">
                        📂 My Tickets
                    </h3>

                    @forelse(auth()->user()->tickets as $ticket)
                        <a
                            href="{{ route('tickets.show', $ticket) }}"
                            class="block border rounded-xl p-4 mb-4 hover:bg-gray-50 transition"
                        >
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="font-semibold text-gray-800">
                                        {{ $ticket->title }}
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        Created {{ $ticket->created_at->diffForHumans() }}
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
                        </a>
                    @empty
                        <p class="text-gray-500 text-sm">
                            No tickets created yet.
                        </p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

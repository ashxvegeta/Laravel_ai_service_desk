<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎫 Ticket Details
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-2xl p-8">

                <!-- Title -->
                <h1 class="text-2xl font-bold text-gray-800 mb-4">
                    {{ $ticket->title }}
                </h1>

                <!-- Status & Priority -->
                <div class="flex flex-wrap gap-4 mb-6">
                    <span class="
                        px-3 py-1 text-sm font-semibold rounded-full
                        @if($ticket->status === 'open') bg-blue-100 text-blue-700
                        @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-700
                        @else bg-green-100 text-green-700
                        @endif
                    ">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>

                    <span class="
                        px-3 py-1 text-sm font-semibold rounded-full
                        @if($ticket->priority === 'low') bg-gray-100 text-gray-700
                        @elseif($ticket->priority === 'medium') bg-indigo-100 text-indigo-700
                        @else bg-red-100 text-red-700
                        @endif
                    ">
                        Priority: {{ ucfirst($ticket->priority) }}
                    </span>
                </div>

                <!-- Description -->
                <div class="border-t pt-4">
                    <h3 class="text-sm font-semibold text-gray-500 mb-2">
                        Description
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $ticket->description }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

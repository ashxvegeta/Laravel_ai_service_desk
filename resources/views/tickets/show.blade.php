<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎫 Ticket Details
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- ================= TICKET INFO ================= -->
            <div class="bg-white shadow-lg rounded-2xl p-8">

                <!-- Title -->
                <h1 class="text-2xl font-bold text-gray-800 mb-4">
                    {{ $ticket->title }}
                </h1>

                <!-- Status & Priority -->
                <div class="flex flex-wrap gap-4 mb-6">
                    <!-- Status -->
                    <span class="
                        px-3 py-1 text-sm font-semibold rounded-full
                        @if($ticket->status === 'open') bg-blue-100 text-blue-700
                        @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-700
                        @else bg-green-100 text-green-700
                        @endif
                    ">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>

                    <!-- Priority -->
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

            <!-- ================= COMMENTS ================= -->
            <div class="bg-white shadow-lg rounded-2xl p-8">
                <h3 class="text-lg font-semibold mb-6">
                    💬 Conversation
                </h3>

            @foreach($ticket->comments as $comment)
    <div class="mb-4 p-4 rounded-xl bg-gray-50">

        <div class="flex justify-between items-center mb-1">
            <strong>
                {{ $comment->user->name }}

                @if($comment->user->role === 'admin')
                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-700">
                        Admin
                    </span>
                @endif
            </strong>

            <span class="text-xs text-gray-500">
                {{ $comment->created_at->diffForHumans() }}
            </span>
        </div>

        <p>{{ $comment->body }}</p>
    </div>
@endforeach

            </div>

            <!-- ================= ADD COMMENT ================= -->
            <div class="bg-white shadow-lg rounded-2xl p-8">
                <h3 class="text-lg font-semibold mb-4">
                    ✍️ Add a Reply
                </h3>

                <form method="POST" action="{{ route('tickets.comments.store', $ticket) }}">
    @csrf

    <textarea
        name="body"
        rows="3"
        required
        class="w-full rounded-lg border-gray-300"
    ></textarea>

    <button type="submit" class="inline-flex items-center px-5 py-2 mt-4 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition"> 🚀 Send Reply</button>
</form>

            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔔 Notifications
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @forelse(auth()->user()->notifications as $notification)
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-5 mb-4 hover:shadow-md transition">
                    
                    <div class="flex items-start gap-4">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600">
                                💬
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <p class="text-gray-800">
                                <strong class="text-indigo-600">
                                    {{ $notification->data['commented_by'] ?? 'System' }}
                                </strong>
                                replied on
                                <span class="font-semibold text-gray-900">
                                    {{ $notification->data['ticket_title'] ?? 'Ticket' }}
                                </span>
                            </p>

                            @if(!empty($notification->data['comment_body']))
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $notification->data['comment_body'] }}
                                </p>
                            @endif

                            <p class="text-xs text-gray-400 mt-2">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty state -->
                <div class="bg-white shadow rounded-xl p-8 text-center">
                    <div class="text-4xl mb-3">🎉</div>
                    <p class="text-gray-600">
                        You have no notifications yet.
                    </p>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>

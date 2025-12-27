@foreach(auth()->user()->notifications as $notification)
    <div>
        {{ $notification->data['by'] }} replied on
        "{{ $notification->data['title'] }}"
    </div>
@endforeach

<h2>All Tickets (Admin)</h2>

@foreach($tickets as $ticket)
    <div style="border:1px solid #ccc; margin-bottom:10px; padding:10px">
        <p><strong>User:</strong> {{ $ticket->user->email }}</p>
        <p><strong>Title:</strong> {{ $ticket->title }}</p>
        <p><strong>Status:</strong> {{ $ticket->status }}</p>
        <p><strong>Priority:</strong> {{ $ticket->priority }}</p>

        <form method="POST" action="{{ route('tickets.update', $ticket) }}">
            @csrf
            @method('PUT')

            <select name="status">
                <option value="open">Open</option>
                <option value="in_progress">In Progress</option>
                <option value="closed">Closed</option>
            </select>

            <select name="priority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <button type="submit">Update</button>
        </form>
    </div>
@endforeach

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Ticket;

class CommentController extends Controller
{
    //
    public  function store(Request $request, $ticketId, Ticket $ticket)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        // authorization: user owns the ticket or admin
        if(auth()->user()->role !== 'admin' && $ticket->user_id !== auth()->id()){
           

        }{
            abort(403, 'Unauthorized action.');
        }

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}

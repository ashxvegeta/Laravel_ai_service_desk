<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Ticket;

class CommentController extends Controller
{
    //
   public function store(Request $request, Ticket $ticket)
{
    $request->validate([
        'body' => 'required|string',
    ]);

    // authorization
    if (auth()->user()->role !== 'admin' && $ticket->user_id !== auth()->id()) {
        abort(403);
    }

    Comment::create([
        'ticket_id' => $ticket->id,
        'user_id' => auth()->id(),
        'body' => $request->body,
    ]);

    if(auth()->user()->role === 'admin'){
        // notify ticket owner about new comment
       $ticket->user->notify(new TicketCommented($ticket, $comment));
    }else{
        // notify all admins about new comment
        User::where('role', 'admin')->each(function($admin) use ($ticket, $comment) {
            $admin->notify(new TicketCommented($ticket, $comment));
        });
    }

    return redirect()->back()->with('success', 'Comment added successfully.');
}
}
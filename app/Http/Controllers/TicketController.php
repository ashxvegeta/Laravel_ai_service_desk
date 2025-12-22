<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->only(['destroy', 'update', 'index']);
    }

    // admin view all tickets
    public function index(){
        $tickets = Ticket::with('user')->latest()->get();
        return view('tickets.admin.index', compact('tickets'));
    }

    // user create a ticket
    public function store(Request $request){
        // validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // create ticket
        Ticket::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Ticket created successfully.');
    }

    /**
     * User/Admin: View a single ticket
     */ 
    public function show($id){
        // Users can only see their own tickets
        if(auth()->user()->role !=='admin' && $tickets->user_id !== auth()->id()){
            abort(403, 'Unauthorized action.');

        }
        return view('tickets.show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket){
        // validate request
        $request->validate([
            'status' => 'required|in:open,closed,in_progress',
            'priority' => 'required|in:low,medium,high',
        ]);

        // update ticket
        $ticket->update([
            'status' => $request->status,
            'priority' => $request->priority,
        ]);

        return redirect()->back()->with('success', 'Ticket updated successfully.');

    }


}

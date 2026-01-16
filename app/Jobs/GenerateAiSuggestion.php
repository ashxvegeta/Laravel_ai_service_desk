<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Models\Comment;
use App\Services\AiTicketAssistant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateAiSuggestion implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */

    public Ticket $ticket;
    
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //

        $answer = $ai->suggest($this->ticket->description);

        if(!$answer){
            return;
        }
        
        Comment::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => null, // AI
            'body' => "🤖 AI Suggestion:\n\n" . $answer,
        ]);
    }
}

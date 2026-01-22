<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Services\AiTicketAssistant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateAiSuggestion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function handle(AiTicketAssistant $ai)
    {
        logger('AI JOB STARTED', [
            'ticket_id' => $this->ticket->id
        ]);

        $answer = $ai->suggest(
            $this->ticket->title . "\n" . $this->ticket->description
        );

        if ($answer) {
            $this->ticket->update([
                'ai_suggestion' => $answer
            ]);
        }
    }
}

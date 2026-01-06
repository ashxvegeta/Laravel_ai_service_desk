<?php

namespace App\Services;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Embedding;

class AiTicketAssistant
{
   
    public function suggest(string $question):?string{
        //generate embedding for the question
        $queryEmbedding = $this->embed($question);
        // find relevent knowledge chunks 
        $relevantChunks = $this->searchRelevant($queryEmbedding);
        //no knowlwedge found
        if(empty($relevantChunks)){
            return null;
        }
        //Build Ai context
        $context = $relevantChunks->pluck('content')->join("\n");

        return  $this->askAi($question, $context);
    }

    
}

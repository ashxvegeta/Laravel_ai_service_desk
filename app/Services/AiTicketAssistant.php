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

     /**
     * Generate embedding vector
     */
    protected function embed(string $text): array{
         // TODO: OpenAI / local embedding call
        $response = OpenAI::embeddings()->create([
            'model' => 'text-embedding-3-small',
            'input' => $text,
        ]);
        // Return the embedding vector
        return $response->data[0]->embedding;
    }

    /**
     * Search relevant chunks using vector similarity
     */

    protected function searchRelevant(array $embedding):Collection{
        // TODO: Vector similarity search in DB
        return collect();
    }

    /**
     * Search relevant chunks using vector similarity
     */

    protected function askAi(string $question, string $context): string{
        // TODO: Call OpenAI / local LLM with context
        return "";
    }
}

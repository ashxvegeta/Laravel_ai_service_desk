<?php

namespace App\Services;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Embedding;
use Illuminate\Support\Collection;

class AiTicketAssistant
{
   
    public function suggest(string $question):?string{
        //generate embedding for the question
        $queryEmbedding = $this->embed($question);
        // find relevent knowledge chunks 
        $relevantChunks = $this->searchRelevant($queryEmbedding);
        //no knowlwedge found
        if ($relevantChunks->isEmpty()) {
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

        protected function cosineSimilarity(array $a, array $b): float
    {
        $dot = 0.0;
        $normA = 0.0;
        $normB = 0.0;

        foreach ($a as $i => $value) {
            $dot += $value * $b[$i];
            $normA += $value ** 2;
            $normB += $b[$i] ** 2;
        }

        return $dot / (sqrt($normA) * sqrt($normB));
    }


    /**
     * Search relevant chunks using vector similarity
     */

            protected function searchRelevant(array $queryEmbedding): Collection
        {
            return Embedding::all()
                ->map(function ($row) use ($queryEmbedding) {
                    return [
                        'content' => $row->content,
                        'similarity' => $this->cosineSimilarity(
                            $queryEmbedding,
                            $row->embedding
                        ),
                    ];
                })
                ->sortByDesc('similarity')
                ->filter(fn ($item) => $item['similarity'] > 0.75)
                ->take(3)
                ->values();
        }


    /**
     * Search relevant chunks using vector similarity
        */

    protected function askAi(string $question, string $context): string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful support assistant. Answer ONLY using the provided knowledge base.'
                ],
                [
                    'role' => 'system',
                    'content' => "Knowledge Base:\n" . $context
                ],
                [
                    'role' => 'user',
                    'content' => $question
                ],
            ],
            'temperature' => 0.2,
        ]);

        return $response->choices[0]->message->content;
    }

}

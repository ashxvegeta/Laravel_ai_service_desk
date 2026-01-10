<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\Embedding;
use Illuminate\Support\Facades\Storage;
use App\Services\AiTicketAssistant;

class KnowledgeBaseController extends Controller
{
    //show upload form
    public function create(){
        return view('admin.knowledge.upload');
    }

    //handle file upload
    public function store(Request $request){

        $request->validate([
             'pdf' => 'required|mimes:pdf|max:10240',
        ]);

        // path 
        $path = $request->file('pdf')->store('knowledge_base_pdfs','private');

           // absolute path (CORRECT)
        $filePath = Storage::disk('private')->path($path);

        if (!file_exists($filePath)) {
            dd('File not found', $filePath);
        }


        // extract text
        $parser =  new Parser();
        $pdf = $parser->parseFile($filePath);
        $text = $pdf->getText();

        // split text into chunks
        $chunks = $this->chunkText($text);

        $ai = app(AiTicketAssistant::class);

        // save chunks (embedding)
        foreach($chunks as $chunk){
            Embedding::create([
                'content'=>$chunk,
                'embedding' => $ai->embed($chunk),
                'source' => basename($path),
            
            ]);
        }
        return redirect()->back()->with('success','Knowledge base updated successfully.');

    }

     // split text into smaller chunks
    protected function chunkText(string $text,int $size = 500): array{

        $words = explode(' ',$text);
        $chunks = [];
        $current = ' ';
        foreach($words as $word){
            if(strlen($current)+strlen($word) < $size){
                $current .= ' ' . $word;
            }else{
                $chunks[] = trim($current);
                $current = $word;
            }
        }
        if(!empty($current)){
            $chunks[] = trim($current);
        }
        return $chunks;

    }


   

}

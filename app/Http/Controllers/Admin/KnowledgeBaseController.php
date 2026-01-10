<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\Embedding;

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
        $path = $request->file('pdf')->store('knowledge_base_pdfs');
        // extract text
        $parser =  new Parser();
        $pdf = $parser->parseFile(storage_path("app/{$path}"));
        $text = $paf->getText();

        // split text into chunks
        $chunks = $this->chunkText($text);

        // save chunks (embedding)
        foreach($chunks as $chunk){
            Embedding::create([
                'content'=>$chunk,
                'embedding' => [],
                'source' => basename($path),
            
            ]);
        }
        return redirect()->back()->with('success','Knowledge base updated successfully.');

    }
}

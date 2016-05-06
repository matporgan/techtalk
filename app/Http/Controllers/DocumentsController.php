<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gate;

use App\Document;
use App\Org;

class DocumentsController extends Controller
{
    /**
     * The base directory, where documents are stored.
     *
     * @var string
     */
    protected $baseDir = 'storage/documents';

    /**
     * Move document to storage location and add to database.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) 
    {
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) { abort(403); }
        
        // create filenames
        $file = $request->file('upload');
        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = $request->name . '.' . $ext;
        $unique_name = time() . $name;
        
        // move file
        $file->move($this->baseDir, $unique_name);

        $org->documents()->create([
            'name' => $name, 
            'description' => $request->description,
            'path' => '/' . $this->baseDir . $unique_name
        ]);
        
        return redirect("/orgs/{$org->id}");
    }

    /**
     * Downloads a given document.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function download($id, $document_id) 
    { 
        $document = Document::findOrFail($document_id);

        return view('downloads.document', compact('document'));
    }

    /**
     * Destroy the document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $document_id) 
    {
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) { abort(403); }
        
    	Document::destroy($document_id);
    	return back();
    }
}

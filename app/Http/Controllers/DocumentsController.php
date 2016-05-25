<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gate;
use Response;
use Session;
use File;

use App\Document;
use App\Org;

class DocumentsController extends Controller
{
    /**
     * The base directory, where documents are stored.
     *
     * @var string
     */
    protected $baseDir = 'storage/documents/';

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
        $file = $request->file('file');
        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $full_name = $request->name . '.' . $ext;
        $unique_name = time() . $full_name;
        
        // move file
        $file->move($this->baseDir, $unique_name);

        $org->documents()->create([
            'name' => $request->name, 
            'ext' => $ext,
            'description' => $request->description,
            'path' => '/' . $this->baseDir . $unique_name
        ]);
        
        Session::flash('success', 'Document successfully added!');
        return back();
    }

    /**
     * Update the specified document.
     *
     * @param  Request $request
     * @param  int  $id
     * @param  int  $link_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $document_id)
    {
        // authorization
        $org = Org::findOrFail($id);
        if (Gate::denies('update-org', $org)) abort(403);

        // update database entry
        $document = Document::findOrFail($document_id);
        $document->update($request->all());

        // flash and redirect
        Session::flash('success', 'Successfully updated!');
        return redirect("/orgs/{$org->id}");
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
        
        $document = Document::findOrFail($document_id);

        // delete document
        $file = public_path() . $document->path;
        File::delete($file);

        // remove from database
    	Document::destroy($document_id);
        
    	return back();
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

        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . $document->path;
        $headers = array(
              "Content-Type: application/octet-stream",
            );
        return Response::download($file, $document->name . '.' . $document->ext, $headers);
    }
}

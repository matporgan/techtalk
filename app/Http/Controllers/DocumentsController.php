<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Document;
use App\Org;

class DocumentsController extends Controller
{
    /**
     * Move document to storage location and add to database.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addDocument(Request $request, $id) 
    {
        $storage = 'storage/documents/';

        $org = Org::findOrFail($id);
        
        // create filenames
        $file = $request->file('upload');
        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = $request->name . '.' . $ext;
        $unique_name = time() . $name;
        
        // move file
        $file->move($storage, $unique_name);

        $org->documents()->create([
            'name' => $name, 
            'description' => $request->description,
            'path' => '/' . $storage . $unique_name
        ]);
        
        return redirect("/orgs/{$org->id}");
    }

    /**
     * Download the document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadDocument($id) {
    	$document = Document::findOrFail($id);

    	return view('documents.download', compact('document'));
    }
}

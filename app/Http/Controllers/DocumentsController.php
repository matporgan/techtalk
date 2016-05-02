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
        $org = Org::findOrFail($id);

        $file = $request->file('file');

        // get file names
        $name = $file->getClientOriginalName();
        $unique_name = time() . $name;

        // move file
        $file->move('storage/documents', $unique_name);

        // create DB entry
        $org->documents()->create(['name' => $name, 'path' => '/storage/documents/'.$unique_name]);
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

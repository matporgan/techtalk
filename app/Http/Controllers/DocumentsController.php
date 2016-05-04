<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Traits\AuthorizesUsers;

use App\Document;
use App\Org;

class DocumentsController extends Controller
{
    use AuthorizesUsers; 

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
        if(! $this->isUserLegit($id)) 
        {
            return $this->unauthorized();
        }
        
        $org = Org::findOrFail($id);
        
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
     * Destroy the document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($org_id, $document_id) {
        if(! $this->isUserLegit($org_id)) 
        {
            return $this->unauthorized();
        }
        
    	Document::destroy($document_id);
    	return back();
    }
}

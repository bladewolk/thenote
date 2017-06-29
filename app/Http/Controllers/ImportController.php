<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Models\Note;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('import.index');
    }

    /**
     * @param ImportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ImportRequest $request){
        if ($request->file('file'))
            Note::import($request->file('file'));

        return redirect()->route('notes.index')
            ->with('success', 'Import DONE');
    }
}

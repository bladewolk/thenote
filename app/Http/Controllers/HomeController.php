<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\Picture;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notes.index',[
            'notes' => Note::with('pictures')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $note = Note::create($request->all());
        if ($request->pictures && !empty($request->pictures)){
            Picture::savePictures($request->pictures, $note);
        }

       return redirect()->route('notes.index')->with('success', 'Note created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('notes.edit', [
            'item' => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, Note $note)
    {
        $note->update($request->all());

        if ($request->pictures && !empty($request->pictures)){
            Picture::savePictures($request->pictures, $note);
        }

        return redirect()->route('notes.index')->with('success', 'Note updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::find($id)->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted');
    }
}

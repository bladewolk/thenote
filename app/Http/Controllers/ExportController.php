<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use File;


class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('export.index',[
            'count' => Note::count()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request){

        if ($request->get('format') == 'txt'){
            Note::exportTXT();
            return response()->download(public_path('export.zip'));
        }

        Note::exportXML();
        return response()->download(public_path('export.zip'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function import(Request $request){
        dd($request->all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use File;
use SoapBox\Formatter\Formatter;


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
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|void
     */
    public function export(Request $request){
        if (File::exists(public_path('export.zip')))
            File::delete(public_path('export.zip'));

        if ($request->format == 'txt')
            return $this->exportTXT();
        return $this->exportXML();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportTXT(){
        File::cleanDirectory(public_path('export'));
        $notes = Note::all();
        foreach ($notes as $note){
            $filename = public_path('export/'.$note->id.'.txt');
            file_put_contents($filename, $note->description);
        }

        $imagePath = glob(public_path('uploads/*'));
        $txtPath = glob(public_path('export/*'));
        Zipper::make(public_path('export.zip'))
            ->add(array_merge($imagePath, $txtPath))
            ->close();

        return response()->download(public_path('export.zip'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportXML(){
        File::cleanDirectory(public_path('export'));
        $notes = Note::all()->toJson();
        $formatter = Formatter::make($notes, Formatter::JSON);
        $xml = $formatter->toXml();
        file_put_contents(public_path('export/'.'notes.xml'), $xml);

        $imagePath = glob(public_path('uploads/*'));
        $xmlPath = [0 => public_path('export/'.'notes.xml')];

        Zipper::make(public_path('export.zip'))
            ->add(array_merge($imagePath, $xmlPath))
            ->close();

        return response()->download(public_path('export.zip'));
    }
}

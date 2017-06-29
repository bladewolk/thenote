<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chumper\Zipper\Facades\Zipper;
use File;
use SoapBox\Formatter\Formatter;

class Note extends Model
{
    protected $fillable = ['description'];

    public function pictures(){
        return $this->morphMany(Picture::class, 'picturetable');
    }

    public static function ExportTXT(){
        if (File::exists(public_path('export.zip')))
            File::delete(public_path('export.zip'));

        File::cleanDirectory(public_path('export'));
        $notes = self::all();
        foreach ($notes as $note){
            $filename = public_path('export/'.$note->id.'.txt');
            file_put_contents($filename, $note->description);
        }

        $imagePath = glob(public_path('uploads/*'));
        $txtPath = glob(public_path('export/*'));
        Zipper::make(public_path('export.zip'))
            ->add(array_merge($imagePath, $txtPath))
            ->close();
    }

    public static function ExportXML(){
        if (File::exists(public_path('export.zip')))
            File::delete(public_path('export.zip'));

        File::cleanDirectory(public_path('export'));
        $notes = self::all()->toJson();
        $formatter = Formatter::make($notes, Formatter::JSON);
        $xml = $formatter->toXml();
        file_put_contents(public_path('export/'.'notes.xml'), $xml);

        $imagePath = glob(public_path('uploads/*'));
        $xmlPath = [0 => public_path('export/'.'notes.xml')];

        Zipper::make(public_path('export.zip'))
            ->add(array_merge($imagePath, $xmlPath))
            ->close();
    }
}

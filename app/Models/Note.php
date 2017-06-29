<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chumper\Zipper\Facades\Zipper;
use File;
use SoapBox\Formatter\Formatter;

class Note extends Model
{
    protected $fillable = ['description', 'short_description'];

    public function pictures(){
        return $this->morphMany(Picture::class, 'picturetable');
    }

    /**
     * Export zip with txt notes and images
     */
    public static function ExportTXT(){
        if (File::exists(public_path('export.zip')))
            File::delete(public_path('export.zip'));

        $notes = self::with('pictures')->get();
        foreach ($notes as $note){
            mkdir(public_path('export/'.$note->id));
            if ($note->pictures->isNotEmpty())
                $note->pictures->each(function($image) use ($note) {
                   File::copy(public_path('uploads/'. $image->name), public_path('export/'. $note->id .'/'.$image->name));
                });

            $filepath = public_path('export/'. $note->id .'/'. $note->id .'.txt');
            file_put_contents($filepath, $note->toJson());
        }

        $foldersPath = glob(public_path('export'));
        Zipper::make(public_path('export.zip'))
            ->add($foldersPath)
            ->close();

        File::cleanDirectory(public_path('export/'));
    }

    /**
     * Export zip with xml with images in same folders
     */
    public static function ExportXML(){
        if (File::exists(public_path('export.zip')))
            File::delete(public_path('export.zip'));

        $notes = self::with('pictures')->get();
        foreach ($notes as $note){
            mkdir(public_path('export/'.$note->id));
            if ($note->pictures->isNotEmpty())
                $note->pictures->each(function($image) use ($note) {
                    File::copy(public_path('uploads/'. $image->name), public_path('export/'. $note->id .'/'.$image->name));
                });
        }

        $formatter = Formatter::make($notes->toJson(), Formatter::JSON);
        file_put_contents(public_path('export/'.'notes.xml'), $formatter->toXml());

        $foldersPath = glob(public_path('export'));
        Zipper::make(public_path('export.zip'))
            ->add($foldersPath)
            ->close();

        File::cleanDirectory(public_path('export/'));
    }

    public static function Import($file){
        if ($file->getClientOriginalExtension() == 'txt'){
            self::create((array)json_decode(File::get($file)));
        }
wrong
        if ($file->getClientOriginalExtension() == 'xml'){
            $items = Formatter::make(File::get($file), Formatter::XML)->toArray();
            foreach ($items['item'] as $item){
                self::create($item);
            }
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;


class Picture extends Model
{
    protected $fillable = ['name'];

    public function picturetable(){
        return $this->morphTo();
    }

    /**
     * @param $pictures
     * @param $item
     */
    public static function savePictures($pictures, $item){
        foreach ($pictures as $key => $image){
            $name = time() . $key .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $name);
            $item->pictures()->create(['name' => $name]);
        }
    }

    /**
     * @param $picture
     * @param $ext
     * @param $item
     */
    public static function importPicture($picture, $ext, $item){
        $name = time() . rand(0,9) .'.'.$ext;
        File::move($picture, public_path('uploads/'. $name));
        $item->pictures()->create(['name' => $name]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['name'];

    public function picturetable(){
        return $this->morphTo();
    }

    public static function savePictures($pictures, $item){
        foreach ($pictures as $key => $image){
            $name = time() . $key .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $name);
            $item->pictures()->create(['name' => $name]);
        }
    }
}

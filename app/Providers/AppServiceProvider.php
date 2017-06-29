<?php

namespace App\Providers;

use App\Models\Note;
use \File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Note::deleting(function($model){
            $model->pictures->each(function($image){
                File::delete(public_path('uploads/'.$image->name));
                $image->delete();
            });
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

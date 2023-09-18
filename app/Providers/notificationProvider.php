<?php

namespace App\Providers;

use App\Models\appointment;
use Illuminate\Support\ServiceProvider;

class notificationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
  

     public function boot()
     {
         view()->composer('*', function ($view) {
             if (auth()->check()) {
                 $id = 1;
                 $count = appointment::where('doctor_id', $id)->where('show',0)->count();
                 $appointmentsnotif = appointment::where('doctor_id',$id)->where('show',0)->get();

             } else {
                 $count = 0;
                 $appointmentsnotif=null ;
             }
     
     
             $view->with([
                 'count' => $count,
                 'appointmentsnotif' => $appointmentsnotif,
             ]);
         });
     }
     
}
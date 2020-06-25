<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
     public function register()
     {
          //
     }

     public function boot()
     {
          config(['app.locale' => 'id']);
          \Carbon\Carbon::setLocale('id');
          
          Schema::defaultStringLength(191);
     }
}

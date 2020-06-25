<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
     protected $guarded = ['id'];
     public $timestamps = false;

     public function user()
     {
          return $this->belongsTo('App\Models\User');
     }

     public function quote()
     {
          return $this->belongsTo('App\Models\Quote');
     }
}

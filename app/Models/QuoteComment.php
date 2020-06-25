<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteComment extends Model
{
     protected $guarded = ['id'];

     public function user()
     {
         return $this->belongsTo('App\Models\User');
     }

     public function quote()
     {
         return $this->belongsTo('App\Models\Quote');
     }

     public function likes()
     {
         return $this->morpMany('App\Models\Like');
     }
}

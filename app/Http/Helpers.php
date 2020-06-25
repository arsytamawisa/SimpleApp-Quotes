<?php

use App\Models\User;

function slug($id)
{
     $users = User::find($id);
     $slug  = str_slug($users->name, '-');

     return $slug;
}

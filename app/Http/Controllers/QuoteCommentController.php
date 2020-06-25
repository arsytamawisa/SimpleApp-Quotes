<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Quote;
use App\Models\QuoteComment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteCommentController extends Controller
{

     public function __construct()
     {
          $this->middleware('auth');
     }


     public function store(Request $request)
     {
          // Insert Comment
          $request->validate( ['subject'     => 'required']);
          $request->merge(    ['user_id'     => Auth::user()->id]);
          $request->merge(    ['quote_id'    => $request->id]);
          QuoteComment::create($request->all());


          // Insert Notification
          $quote = Quote::findOrFail($request->id);
          if ($quote->user->id != Auth::user()->id)
          {
               Notification::create([
                    'user_id'      => $quote->user->id,
                    'quote_id'     => $request->id,
                    'subject'      => 'ada komentar dari ' . Auth::user()->name,
               ]);
          }

          return redirect()->back();
     }


     public function update(Request $request, $id)
     {
          $data = request()->except(['_token','_method']);
          QuoteComment::where('id', $id)->update($data);

          return redirect()->back();
     }


     public function destroy($id)
     {
          QuoteComment::destroy($id);
          return redirect()->back();
     }
}

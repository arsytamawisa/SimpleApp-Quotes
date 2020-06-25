<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tag;
use App\Models\User;
use App\Models\Like;
use App\Models\Quote;
use App\Models\QuoteComment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{

     public function __construct()
     {
          $this->middleware('auth');
     }


     public function index()
     {
          $quotes = Quote::with('tags')->get();
          $tags   = Tag::all();

          return view('quotes.index', compact('quotes','tags'));
     }


     public function create()
     {
          $tags = Tag::all();

          return view('quotes.create', compact('tags'));
     }


     public function store(Request $request)
     {
          $request->validate([
               'title'     => 'required',
               'subject'   => 'required',
          ]);

          $request->tags = array_unique(array_diff($request->tags, [0]));
          if(empty($request->tags))
          return redirect()->back()->withInput($request->all());

          $slug = str_slug($request->title, '-');
          if ( Quote::where('slug', $slug)->first() != null )
          $slug = $slug .'-'. time();

          $quote = Quote::create([
               'title'   => $request->title,
               'slug'    => $slug,
               'subject' => $request->subject,
               'user_id' => Auth::user()->id,
          ]);

          $quote->tags()->attach($request->tags);

          return redirect('/quotes');
     }


     public function show($slug)
     {
          $tags     = Tag::all();
          $quote    = Quote::where('slug', $slug)->first();
          $comments = QuoteComment::where('quote_id', $quote->id)->get();

          if(empty($quote)) abort(404);

          return view('quotes.show', compact('quote','comments','tags') );
     }


     public function like($type, $model_id)
     {
          if($type == 1)
          $model_type = "App\Model\Quote";
          else
          $model_type = "App\Model\QuoteComment";

          $model = Quote::find($model_id);

          // if($model->is_liked() == null)
          // {
          Like::create([
               'user_id'       => Auth::user()->id,
               'likeable_id'   => $model_id,
               'likeable_type' => $model_type,
          ]);
          // }

     }


     public function update(Request $request, $id)
     {
          $request->validate([
               'title'     => 'required',
               'subject'   => 'required',
          ]);

          $request->tags = array_diff($request->tags, [0]);
          if(empty($request->tags))
          return redirect()->back()->withInput($request->all());

          $quote = Quote::findOrFail($id);
          if($quote->writter())
          {
               $quote->update([
                    'title'        => $request->title,
                    'subject'      => $request->subject,
               ]);
               $quote->tags()->sync($request->tags);
          }
          else abort(403);

          return redirect('quotes/'.$quote->slug);
     }


     public function destroy(Quote $quote)
     {
          Quote::destroy($quote->id);
          return redirect('quotes');
     }



     // UserControler

     public function profile($slug)
     {
          $user = User::where('slug', $slug)->first();
          return view('quotes.profile', compact('user'));
     }


     public function notifications()
     {
          $model         = new Notification;
          $notifications = Notification::where('notifications.user_id', Auth::user()->id)->get();

          return view('user.notifications', compact('notifications','model'));
     }


     public function deleteNotifications(Request $request)
     {
          Notification::destroy($request->id);
          return redirect()->back();
     }

}

@extends('layouts.app')

@php
$model::where('user_id', Auth::user()->id)->where('seen', 0)->update(['seen' => 1])
@endphp

@section('content')
<div class="container">
     <div class="row">
          @foreach($notifications as $notification)
          <div class="col-md-12 mb-2">
               <div class="card">
                    <div class="card-body">
                         <form action="/notifications/{{ $notification->id }}" method="post"> @csrf @method('delete')
                              <span>
                                   {{ $notification->subject }} di quote
                                   <a href="/quotes/{{ $notification->quote->slug }}">{{ $notification->quote->title }}</a>
                                   {{ $notification->quote->created_at->diffForHumans() }}
                              </span>
                              <span>
                                   <button type="submit" class="btn btn-danger btn-sm pull-right">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                   </button>
                              </span>
                         </form>
                    </div>
               </div>
          </div>

          @endforeach
     </div>
</div>
@endsection

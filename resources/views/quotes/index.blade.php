@extends('layouts.app')

@section('content')
<div class="container">

     <div class="row">
          <div class="col-md-1 col-xs-3 mb-5">
               <a href="/quotes/create">
                    <span class="badge badge-secondary">
                         <i class="fa fa-free-code-camp" aria-hidden="true"></i>
                         Trending
                    </span>
               </a>
          </div>
          <div class="col-md-1 col-xs-3 mb-5">
               <a href="/quotes/create">
                    <span class="badge badge-secondary">
                         <i class="fa fa-user-circle-o"></i>
                         My Quotes
                    </span>
               </a>
          </div>
          <div class="col-md-1 col-xs-3 mb-5">
               <a href="/quotes/create">
                    <span class="badge badge-secondary">
                         <i class="fa fa-heart-o" aria-hidden="true"></i>
                         Favorites
                    </span>
               </a>
          </div>
          <div class="col-md-1 mb-5">
               <a href="/quotes/create" class="btn btn-outline-dark">
                    Create
               </a>
          </div>
          <div class="col-md-4 mb-5">
               <div class="input-group">
                    <select class="form-control selectpicker" data-live-search="true">
                         <option data-tokens="">Filter Tag</option>
                         @foreach($tags as $tag)
                         <option data-tokens="{{ $tag->name }}">{{ $tag->name }}</option>
                         @endforeach
                    </select>
               </div>
          </div>
          <div class="col-md-4 mb-4">
               <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Quote..">
                    <div class="input-group-append">
                         <button class="btn btn-outline-dark" type="submit">
                              <i class="fa fa-search"></i>
                         </button>
                    </div>
               </div>
          </div>
     </div>

     <div class="row">

          @foreach($quotes as $quote)
          <div class="col-md-4 mb-4">
               <div class="card">

                    <!-- Random Colors -->
                    <?php $random = ['primary','secondary','success ','danger','dark'] ?>
                    <?php $random = $random[array_rand($random)] ?>

                    <div class="card-header text-white bg-dark">
                         <a href="/quotes/{{ $quote->slug }}" class="text-white text-bold">{{ $quote->title }}</a>
                    </div>

                    <div class="card-body" style="min-height:160px">
                         <p class="font-italic font-weight-bolder">"{{ $quote->subject }}"</p>
                         @foreach($quote->tags as $tag)
                         <p class="badge badge-secondary">{{ $tag->name }}</p>
                         @endforeach
                         <footer class="blockquote-footer text-right">by
                              <a href="/profile/{{ $quote->user->id }}" class="text-secondary">{{ $quote->user->name }}</a>
                         </footer>
                    </div>

               </div>
          </div>
          @endforeach

     </div>
</div>
@endsection

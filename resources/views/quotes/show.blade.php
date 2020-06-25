@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row">

          <div class="jumbotron w-100">
               <h1>{{ $quote->title }}</h1>

               <p class="lead">{{ $quote->subject }}</p>
               <hr class="my-4">
               <p>
                    <span>{{ $quote->created_at->diffForHumans() }}</span>
                    <span class="float-right">written by: <a href="/profile/{{ $quote->user->id }}" class="badge badge-secondary">{{ $quote->user->name }}</a></footer></span>
               </p>
               <div class="row">
                    <div class="col-md-8">

                         <!-- Like Quote -->
                         <button type="button" class="btn btn-dark mr-2 btn-like" data-model-id="{{ $quote->id }}" data-type="1">
                              <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                              <span id="count">{{ $quote->likes->count() }}</span>
                         </button>
                         <script src="{{ asset('js/like.js') }}"></script>

                         <button class="btn btn-dark mr-2" type="button" data-toggle="collapse" data-target="#comments" aria-expanded="false" aria-controls="comments">
                              <i class="fa fa-comment" aria-hidden="true"></i>
                              {{ $comments->count() }}
                         </button>
                         @if( $quote->writter() )
                         <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                              <i class="fa fa-bars" aria-hidden="true"></i>
                         </button>
                         @endif
                    </div>
                    <div class="col-md-4">
                         <a href="/quotes" class="btn btn-dark float-right">
                              Back to Qoutes
                         </a>
                    </div>
               </div>

               <!-- Collapse  -->
               <div class="collapse mt-3" id="collapseExample">
                    <form action="{{ route('quotes.destroy', $quote->id) }}" method="post"> @method('delete') @csrf
                         <button type="button" class="btn btn-secondary mr-2" data-toggle="modal" data-target="#update">Update</button>
                         <button type="submit" class="btn btn-secondary">Delete</button>
                    </form>
               </div>

               <!-- Comments -->
               <div class="collapse mt-3" id="comments">
                    <h4 class="mt-4">Comments</h4>
                    <hr>

                    @foreach($comments as $comment)
                    @if(Auth::user()->id == $comment->user->id)
                    <a href="/profile/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                    <p>
                         <span><i class="fa fa-clock-o" aria-hidden="true"> {{ $comment->updated_at->diffForHumans() }}</i></span>

                         <!-- Delete Comment -->
                         <form action="/quote-comment/{{ $comment->id }}" method="post"> @csrf @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm pull-right">
                                   <i class="fa fa-trash" aria-hidden="true"></i>
                              </button>
                         </form>

                         <!-- Button Edit Comment -->
                         <button type="button" class="btn btn-primary btn-sm pull-right mr-2" data-toggle="modal" data-target="#asd{{ $loop->iteration }}asd">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                         </button>
                    </p>
                    <p>{{ $comment->subject }}</p>
                    <hr>

                    @else
                    <a href="/profile/{{ $comment->user->id }}">--creator--</a>
                    <p>
                         <span><i class="fa fa-clock-o" aria-hidden="true"> {{ $comment->updated_at->diffForHumans() }}</i></span>
                         <span></span>
                    </p>
                    <p>{{ $comment->subject }}</p>

                    <!-- Like Comment -->
                    <!-- <button type="button" class="btn btn-primary btn-sm mr-2 btn-like" data-model-id="{{ $comment->id }}" data-type="2">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i> 2
               </button> -->

               <hr>
               @endif
               @endforeach

               <!-- Form Submit Comment -->
               <form action="/quote-comment/{{ $quote->id }}" method="post"> @csrf
                    <textarea name="subject" class="form-control"></textarea>
                    <button type="submit" class="btn btn-primary float-right mt-3">Comment</button>
               </form>
          </div>
     </div>

</div>
</div>


<!-- Modal Update Quote -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Update Quote</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="/quotes/{{ $quote->id }}" method="post"> @method('patch') @csrf
                    <div class="modal-body">
                         <div class="form-group">
                              <label>Title</label>
                              <input type="text" name="title" value="{{ $quote->title }}" class="form-control">
                         </div>
                         <div class="form-group">
                              <label>Subject</label>
                              <textarea name="subject" class="form-control">{{ $quote->subject }}</textarea>
                         </div>

                         <span id="add_tag"> Add Tag
                              <i class="fa fa-plus-circle ml-1" aria-hidden="true"></i>
                         </span>
                         <div class="row mt-2" id="tag_wrapper">
                              @if($quote->tags !== [])
                                   @foreach($quote->tags as $quote_tag)
                                   <div class="col-md-4" id="tag_select">
                                        <div class="input-group">
                                             <select class="custom-select" name="tags[]">
                                                  <option value="0">Select Tag</option>
                                                  @foreach($tags as $tag)
                                                  <option value="{{ $tag->id }}" @if($tag->id == $quote_tag->id) selected @endif>
                                                       {{ $tag->name }}
                                                  </option>
                                                  @endforeach
                                             </select>
                                             <div class="input-group-append">
                                                  <button class="btn btn-outline-dark" type="button" id="remove_tag">
                                                       <i class="fa fa-remove"></i>
                                                  </button>
                                             </div>
                                        </div>
                                   </div>
                                   @endforeach
                              @else
                              <div class="col-md-4" id="tag_select">
                                   <div class="input-group">
                                        <select class="custom-select" name="tags[]">
                                             <option value="0">Select Tag</option>
                                             @foreach($tags as $tag)
                                             <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                             @endforeach
                                        </select>
                                        <div class="input-group-append">
                                             <button class="btn btn-outline-dark" type="button" id="remove_tag">
                                                  <i class="fa fa-remove"></i>
                                             </button>
                                        </div>
                                   </div>
                              </div>
                              @endif


                         </div>
                         <script src="{{ asset('js/tag.js') }}"></script>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-dark float-right">Update</button>
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
               </form>
          </div>
     </div>
</div>


<!-- Modal Edit Comment -->
@if(!empty($comment))
@foreach($comments as $data)
<form action="/quote-comment/{{ $data->id }}" method="post"> @method('patch') @csrf
     <div class="modal fade" id="asd{{ $loop->iteration }}asd" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title">Edit Comment</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal-body">
                         <textarea name="subject" class="form-control">{{ $data->subject }}</textarea>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
               </div>
          </div>
     </div>
</form>
@endforeach
@endif

@endsection

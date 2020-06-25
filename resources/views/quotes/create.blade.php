@extends('layouts.app')

@section('content')
<div class="container">
     <form action="/quotes" method="post"> @csrf
          <div class="form-group">
               <label>Title</label>
               <input type="text" name="title" class="form-control" value="{{ old('title') }}">
          </div>

          <div class="form-group">
               <label>Subject</label>
               <textarea name="subject" class="form-control">{{ old('subject') }}</textarea>
          </div>

          <span id="add_tag"> Add Tag
               <i class="fa fa-plus-circle ml-1" aria-hidden="true"></i>
          </span>

          <div class="row mb-5 mt-2" id="tag_wrapper">
               @if( old('tags') )
               @for( $i=0; $i < count(old('tags')); $i++)
               <div class="col-md-4" id="tag_select">
                    <select class="form-control" name="tags[]">
                         <option value="0">Select Tag</option>
                         @foreach($tags as $tag)
                         <option value="{{ $tag->id }}" @if( old('tags.'.$i) == $tag->id ) selected @endif>
                              {{ $tag->name }}
                         </option>
                         @endforeach
                    </select>
               </div>
               @endfor
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

          <a href="/quotes" class="btn btn-outline-dark float-right ml-3">Back</a>
          <button type="submit" class="btn btn-dark float-right">Submit</button>
     </form>

</div>
@endsection

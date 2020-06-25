@extends('layouts.app')

@section('content')

<div class="container">
     <div class="row">
          <div class="col-6 offset-3">
               <div class="card">
                    <div class="card-body">
                         <div class="row">
                              <div class="col-12 col-lg-8 col-md-6">
                                   <h3 class="mb-0 text-truncated">{{ $user->name }}</h3>
                                   <p class="lead">Backend Programmer - Kebumen</p>
                                   <p>
                                        I love to read, hang out with friends, watch football, listen to music, and learn new things.
                                   </p>
                                   <p> <span class="badge badge-primary tags">laravel</span>
                                        <span class="badge badge-primary tags">vuejs</span>
                                        <span class="badge badge-primary tags">codeigniter</span>
                                   </p>
                              </div>
                              <div class="col-12 col-lg-4 col-md-6 text-center">
                                   <img src="https://robohash.org/68.186.255.198.png" alt="" class="mx-auto rounded-circle img-fluid">
                                   <br>
                                   <ul class="list-inline ratings text-center" title="Ratings">
                                        <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                        </li>
                                   </ul>
                              </div>
                              <div class="col-12 col-lg-4">
                                   <h3 class="mb-0">20.7K</h3>
                                   <small>Followers</small>
                                   <button class="btn btn-block btn-outline-success"><span class="fa fa-plus-circle"></span> Follow</button>
                              </div>
                              <div class="col-12 col-lg-4">
                                   <h3 class="mb-0">245</h3>
                                   <small>Quotes</small>
                                   <button class="btn btn-outline-dark btn-block"><span class="fa fa-user"></span> View Quotes</button>
                              </div>
                              <div class="col-12 col-lg-4">
                                   <button type="button" class="btn btn-outline-primary btn-block"><span class="fa fa-star"></span> Review</button>
                              </div>
                              <!--/col-->
                         </div>
                         <!--/row-->
                    </div>
                    <!--/card-block-->
               </div>
          </div>
     </div>
</div>

@stop

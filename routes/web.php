<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
     Route::post('quote-comment/{id}','QuoteCommentController@store');
     Route::patch('quote-comment/{id}','QuoteCommentController@update');
     Route::delete('quote-comment/{id}','QuoteCommentController@destroy');
     Route::get('profile/{id?}','QuoteController@profile');
     Route::resource('quotes','QuoteController', ['except' => 'index', 'show']);
     Route::get('like/{type}/{model}','QuoteController@like');
     Route::get('notifications','QuoteController@notifications');
     Route::delete('notifications/{id}','QuoteController@deleteNotifications');
});

Route::get('/','QuoteController@index');
Route::resource('quotes','QuoteController', ['only' => 'index', 'show']);

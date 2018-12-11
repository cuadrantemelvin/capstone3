<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return Auth::user()->test();
});





Auth::routes();







Route::group(['middleware' => 'auth'], function (){
	Route::get('/home','HomeController@getDashboard')->name('home');
	Route::get('/profile/{id}', 'ProfileController@index')->name('profile');
	Route::get('/changePhoto', 'ProfileController@changePhoto');
	Route::post('/uploadPhoto', 'ProfileController@uploadPhoto');
	Route::get('/editProfile', 'ProfileController@editProfile')->name('editProfile');
	 Route::post('/updateProfile', 'ProfileController@updateProfile');
	Route::get('/findFriends', 'ProfileController@findFriends');
	Route::get('/addFriends/{id}', 'ProfileController@sendRequest');
	Route::get('/requests', 'ProfileController@requests');
	Route::get('/accept/{name}/{id}', 'ProfileController@accept');
	Route::get('/friends', 'ProfileController@friends');
	Route::get('/requestRemove/{id}', 'ProfileController@requestRemove');
	Route::get('/notifications/{id}', 'ProfileController@notifications');
	Route::get('/unfriend/{id}', function($id){
             $loggedUser = Auth::user()->id;
              DB::table('friendships')
              ->where('requester', $loggedUser)
              ->where('user_requested', $id)
              ->delete();
              DB::table('friendships')
              ->where('user_requested', $loggedUser)
              ->where('requester', $id)
              ->delete();
               return back()->with('msg', 'You are not friend with this person');
        });

	Route::post('/createpost','PostController@postCreatePost')->name('post.create');

    

    Route::get('/post/{id}/edit', 'PostController@edit')->name('post.edit');
    Route::get('/post/{id}/show', 'PostController@show')->name('post.show');


    Route::patch('/post/{id}/update', 'PostController@update')->name('post.update');
    Route::delete('/post/{id}/delete', 'PostController@destroy')->name('post.delete');
    Route::post('/like','PostController@postLikePost')->name('like');
    Route::post('/comment','CommentController@index');

});

Route::get('/logout','Auth\LoginController@logout');

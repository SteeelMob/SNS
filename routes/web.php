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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//
//Route::post('/top', 'Auth\LoginController@login');


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login') ->name('login'); 
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::group(['middleware' => 'auth'], function () { //ログイン認証囲ページを囲む
Route::get('/top','PostsController@index');
Route::post('/top','PostsController@index');
//投稿用ルーティング
Route::post('/create','PostsController@create');
Route::get('/create','PostsController@create');
//投稿の一覧表示
Route::get('/posts' , 'PoseController@index');
//編集用 送信方法はpost
Route::post('/post/update','PostsController@update');
//消去用
Route::get('/post/{id}/delete','PostsController@delete');

Route::get('/profile','UsersController@profile');
//プロフィール編集
Route::post('/profile/{id}/update','UsersController@update');

Route::get('/search','UsersController@search')->name('users.search'); //nameでルート名を記述
Route::post('/search','UsersController@search');//indexをsearchに変更
// Route::get('/searching','UsersController@searching')->name('posts.searching');
// Route::post('/searching','UsersController@searching');

//フォローフォロワーリスト
Route::get('/followList','PostsController@followList')->name('followList');
Route::post('/followList','PostsController@followList');
Route::get('/followerList','PostsController@followerList')->name('followerList');
Route::post('/followerList','PostsController@followerList');

//ログアウト実装ルーティング
Route::post('/logout','Auth\LoginController@logout'); //getとpostがあるのはログインではgetでページ移動のためpostでmailとpasswordを入力してログインさせるため
Route::get('/logout','Auth\LoginController@logout'); //上記で行ってるのと同じ原理でログアウトのルーティングを記述


//フォロー/解除のルーティング
Route::post('/users/{user}/follow','FollowsController@follow')->name('follow');
Route::delete('/users/{user}/unfollow','FollowsController@unfollow')->name('unfollow');


});
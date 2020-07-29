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


// 上に戻しました。
// これはコメントにして
// Route::get('/', 'TasksController@index');



// これはそのままでいいのだろうか？ とりあえずこのまま
Route::resource('tasks', 'TasksController');




// ユーザ登録のためのルーティング設定
// ->name() はこのルーティングに名前をつけているだけです。後ほど、 Formやlink_to_route() で使用することになります。
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');




// 認証は、LoginControllerが担当します。以下の3つのルーティングを routes/web.php に追記してください。
// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
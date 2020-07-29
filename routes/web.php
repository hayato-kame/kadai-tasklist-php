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



//  今まで / はRouterからControllerへ飛ばさずに直接welcomeのViewを表示させていました。
// しかし、これを変更するので コメントにします 教科書9.2 のところです

// Route::get('/', function () {
//     return view('welcome');
// });




//  教科書9.2 のところです  ここからは少し複雑なことを行っていくのですが、上記の記述を下記のように変更し、
//  Controller ( TasksController@index ) を経由してwelcomeを表示するようにします。
 Route::get('/', 'TasksController@index');



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




Route::group(['middleware' => ['auth']], function () {
    
    
    // これはユーザー一覧ユーザー詳細のための設定なので とりあえずコメント
    // Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);


// 認証を必要とするルーティンググループ内に、 Taskのルーティングを設定します（登録のstoreと削除のdestroyのみ）
// これで、認証済みのユーザだけがこれらのアクションにアクセスできます。
    Route::resource('tasks', 'TasksController', ['only' => ['store', 'destroy']]);
    
});



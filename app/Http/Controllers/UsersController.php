<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ここではindexとshowのみを実装します。 createアクションやstoreアクションについてはRegisterControllerで実装されているため不要です。
// Userに関するControllerを2つ用意する形となります。

class UsersController extends Controller
{
    
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        // $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        // return view('users.index', [
        //     'users' => $users,
        // ]);
    }
    
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // ユーザ詳細ビューでそれを表示
        // ユーザー詳細は要らないのでコメントアウト
        // return view('users.show', [
        //     'user' => $user,
        // ]);
        
        
        
         // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);



        // ユーザ詳細ビューで  ユーザの投稿一覧を表示
        return view('users.show', [
            'user' => $user,
            'tasks' => $tasks,
        ]);
        
        
        
        
    }
    
}

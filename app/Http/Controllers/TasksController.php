<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;  // 追加  このControllerは App\Task のModel操作が主な役割なので
//  use App\Task;  と書くことで、わざわざ App の名前空間を書かなくてよくなります
// つまり、これで  App\Task::all()  ではなくて  Task::all() などと書けば 良くなりました

class TasksController extends Controller
{
    /**
     * Display a listing of the resource. 一覧表示処理
     * getでtasks/にアクセスされた場合
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        // タスク一覧を取得する
        $tasks = Task::all();    //  上のほうで  use App\Task; してるので、App\Task::all()  とは書かなくていい
        
        // タスク一覧ビューでそれを表示
        // view() という関数を呼び出しています 第１引数には　表示したいViewを指定して
        // tasks.index は resources/views/tasks/index.blade.php を意味します。
        // 第2引数には index.blade.php のビューに渡したいデータを連想配列で指定する
        // $tasks = Task::all();   によって  $tasks に入った データ（配列）をビューに渡す
        // Controllerから特定のViewを呼び出すには、 view() を使えば良い
        // return view('tasks.index'); を呼び出すことになります。
        // tasks.index となっているのは、 index.blade.php が resouces/views/tasks/index.blade.php に配置されているからです。
        // resources/views 以下にフォルダがある場合には フォルダ名.ファイル名 という形で指定します。
        // [] 連想配列として、渡したいものを指定する 'キー' => 変数などの値  をカンマ区切りで書く
        
        // ビューファイル側では 'キー'で呼び出します
        //  もしも以下のように左側が test ならば、Viewのファイル側では $tasks ではなく、 $test という変数として呼び出すことができるようになります。
        //  ['test' => $messages,]
       //   'tasks/index' で指定した   resouces/views/tasks/index.blade.php をみて見てください
        
        return view('tasks.index', [
            'tasks' => $tasks,
            ]);
   
    }

    /**
     * Show the form for creating a new resource.新規登録画面表示処理
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.新規登録処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.取得表示処理
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.更新画面表示処理
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.更新処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.削除処理
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

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
        // タスク一覧を取得する  一覧であり、複数のデータを配列で取得するので、変数名は複数形です
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
        //  もしも以下のように左側が hoge ならば、Viewのファイル側では $tasks ではなく、 $hoge という変数として呼び出すことができるようになります。
        //  ['hoge' => $tasks,]
       //   'tasks/index' で  指定した、 表示するビューである  resouces/views/tasks/index.blade.php をみて見てください
        
        return view('tasks.index', [
            'tasks' => $tasks,
            ]);
   
    }

    /**
     * Show the form for creating a new resource.新規登録画面表示処理
     * 空のインスタンスを作成して、ビューへ送る
     * 空のインスタンスを作成してるので、プロパティには　それぞれの初期値が入ってる
     * @return \Illuminate\Http\Response
     * 
     */
    public function create()
    {
        $task = new Task;  //  空のインスタンスを作成してるので、プロパティには　それぞれの初期値が入ってる
        
        //  view関数では 第１引数には　表示したいViewを指定して
        //  tasks.create は resources/views/tasks/create.blade.php を意味します。
        //  resources/views/tasks/create.blade.php  ファイルを見てください
        //  第2引数には create.blade.php のビューに渡したいデータを連想配列で指定する 'task' => $task なら ビューでは $task で取得し、
        //  'hoge' => $task  なら　ビューでは $hoge  で取得することになります。　'キー'　で指定したものが、　ビューで取得する変数名になるので注意
        
        return view('tasks.create',[
            'task' => $task,
            ]);
        
    }

    /**
     * Store a newly created resource in storage.新規登録処理
     * storeアクションでは、 createのページから送信されるフォームを処理することになります
     * 送られてきたフォームの内容は $request に入っています。したがって、 $request から content を取り出して、
     * 新規作成したメッセージインスタンスに代入・保存します。
     * storeアクションの最後では redirect('/') として、 Viewを返さずに / へリダイレクト（自動でページを移動）させています。
     * Viewを作成しても良いですが、わざわざ作成する必要もないでしょう
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // タスクを作成
        $task = new Task;
        $task->content = $request->content;
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.取得表示処理
     * 
     * getでtasks/idにアクセスされた場合
     * 
     * showアクションには $id の引数が与えられます。
     * これは /tasks/1, /tasks/4 といったURLにアクセスされたとき、 $id = 1 や $id = 4 のように代入されます。
     * 
     * $id が指定されているので、 $task = Task::findOrFail($id); によって1つだけ取得します
     * findOrFailについて
     * findと同じく、指定されたレコードを取得しますが、
     * findOrFail はレコードが存在しない時に404エラー（Not foundエラー）を出します
     * 
     * 
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      // Controllerから特定のViewを呼び出すには、 view() を使えば良い
        // return view('tasks.show'); を呼び出すことになります。
        // tasks.show となっているのは、 show.blade.php が resouces/views/tasks/show.blade.php に配置されているからです。
        // resources/views 以下にフォルダがある場合には フォルダ名.ファイル名 という形で指定します。
        // [] 連想配列として、渡したいものを指定する 'キー' => 変数などの値  をカンマ区切りで書く
        
        // ビューファイル側では 'キー'で呼び出します
        //  もしも以下のように左側のキーが hoge ならば、Viewのファイル側では $task ではなく、 $hoge という変数として呼び出すことができるようになります。
        //  ['hoge' => $task,]
       //   'tasks/show' で  指定した、  表示するビューである resouces/views/tasks/show.blade.php をみて見てください
        
    public function show($id)
    {
        // idの値でメッセージを検索して取得 １つだけ取得されるので、 変数名は単数形です
        $task = Task::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
        ]);
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

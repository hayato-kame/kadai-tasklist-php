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
         //  上のほうで  use App\Task; してるので、App\Task::all()  とは書かなくていい
        // タスク一覧を取得する  一覧であり、複数のデータを配列で取得するので、変数名は複数形です
    
    public function index()
    {
        
        
        // これをコメントにして　以下に書き換えました 教科書9.3のところで
        /**
        $tasks = Task::all();   
        return view('tasks.index', [
            'tasks' => $tasks,
            ]);
        */
        
        
        
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            
            
            // この１行追加した
            $status = $user->status()->orderBy('created_at', 'desc')->paginate(10); 
            
            
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);  // ページネートしないと

            $data = [
                'user' => $user,
                'tasks' => $tasks,
                'status' => $status,  // 追加した
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
            
            
   
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
     * 
     * このままだと、PHP側はカラのタスクを投稿してもそのままタスクとして保存しようとします。
     * データベース側ではcontentカラムにNOT NULL制約をかけているため、
     * カラのタスクを投稿しようとすると、制約に違反するためシステムエラーが発生します。
     * システムエラーを防ぐためにも、バリデーションを行う必要があります。
     * 必要なバリデーション項目は以下の2項目
     * content が空になっていないか
     * content が255文字を超えていないか（content カラムは varchar(255) のデータ型なため）
     * 
     * $request->validate() を使用してバリデーションを行います。 
     * $request の content に対して、
     * required (カラでない）かつ max:255 (255文字を超えていない）であることを検証しています
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // バリデーション
        $request->validate([
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:255',  // 任意だけど追加しました
        ]);
        
        
        /** 
         * 9.4 で変更したので コメントアウトする　以下に変更した
        // タスクを作成
        $task = new Task;
         $task->status = $request->status;  // 追加
        $task->content = $request->content;
        $task->save();
        // トップページへリダイレクトさせる
        return redirect('/');
        
        */
        
        
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->tasks()->create([
           'status' => $request->status, 
            'content' => $request->content,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
        
        // return back() とすることで、前のページへリダイレクトされます。この store アクションの場合、リクエスト元の投稿フォームのページへ戻ることになります。
        
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

        // タスク詳細ビューでそれを表示 'tasks.show'とは、show.blade.php が resouces/views/tasks/show.blade.php に配置されているからです。
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.更新画面表示処理
     * getで!!
     * getでtasks/id/editにアクセスされた場合
     * editアクションには $id の引数が与えられます。
     * これは /tasks/1, /tasks/4 といったURLにアクセスされたとき、 $id = 1 や $id = 4 のように代入されます。
     * 
     * $id が指定されているので、 $task = Task::findOrFail($id); によって1つだけ取得します
         return view('tasks.edit'); を呼び出すことになります。
        tasks.edit となっているのは、 edit.blade.php が resouces/views/tasks/edit.blade.php に配置されているからです。
         resources/views 以下にフォルダがある場合には フォルダ名.ファイル名 という形で指定します。
         [] 連想配列として、渡したいものを指定する 'キー' => 変数などの値  をカンマ区切りで書く
   
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値でメッセージを検索して取得  1件取得するので変数名は単数形
        // findOrFail はレコードが存在しない時に404エラー（Not foundエラー）を出します
      
        
        // 編集なので、$task 変数に格納されているオブジェクトの各プロパティには、もうすでに値が入っています
        
        $task = Task::findOrFail($id); 

        // タスク編集ビューでそれを表示
        // ビュー側では キーを元にして取得します、もし、
        // 'task' => $task ではなくて 'hoge' => $task  と書いたら、 
        // ビュー側では、 $hoge とい変数名で取得することになりますので、注意する
        
        // view関数   Controllerから特定のViewを呼び出すには、 view() を使えば良い
        
        return view('tasks.edit', [
            'task' => $task,
        ]);
        
    }
    

    /**
     * Update the specified resource in storage.更新処理
     * 
     * put  または  patchで !!
     * putまたはpatchでtasks/idにアクセスされた場合
     * 
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // バリデーション
        $request->validate([
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:255',  // 任意だけど追加しました
        ]);
        
        
        
        // idの値でタスクを検索してデータベースから取得
        $task = Task::findOrFail($id);
        
        // タスクを更新
         $task->status = $request->status;  // 追加
        $task->content = $request->content;
        $task->save();

        // トップページへリダイレクトさせる
        //  view関数   Controllerから特定のViewを呼び出すには、 view() を使えば良いが、
        // 今回は リダイレクトしているためViewは不要です
       
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     * delete で!! 
     * delete で tasks/idにアクセスされた場合
     * 
     * 投稿の削除を実装します
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値でタスクを検索して取得
        $task = \App\Task::findOrFail($id);
        
        
        
        /**
         * 教科書の9.5 で変更してるのでコメントアウトする以下に変更した
        // タスクを削除
        $task->delete();
        // トップページへリダイレクトさせる
        return redirect('/');
        */
        
        
        
        // 他者のTaskを勝手に削除されないよう、ログインユーザのIDとTaskの所有者のID（user_id）が一致しているかを調べるようにしています。
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $task->user_id) {  //  削除を実行する部分は、if文で囲みました。
            $task->delete();
        }

        // 前のURLへリダイレクトさせる
        return back();
        
    }
}

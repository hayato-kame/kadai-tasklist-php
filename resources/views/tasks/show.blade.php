@extends('layouts.app')

@section('content')

{{-- コメントです --}}
 {{--  --}}
 {{--  --}}
{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}


{{-- TasksController の showアクションが実行されて ここに遷移してくる --}}

{{-- Viewに渡された $task にはレコード1件が格納されているため、それを使用して表示を行います。 --}}


 

 <h1>id = {{ $task->id }} のタスク詳細ページ</h1>
 
 

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{ $task->status }}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $task->content }}</td>
        </tr>
    </table>
    
    
    
     
 {{-- タスク編集ページへのリンク aタグの代わりにLaravel Collectiveの link_to_route() 関数を利用 
     'tasks.edit' で　TasksController の editアクション へ行くようにしてる   $task->id  で　idプロパティの情報を送ってる その後でビューのedit.blade.phpへ行く　--}}
     
     
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['task' => $task->id], ['class' => 'btn btn-light']) !!}




{{-- タスク削除フォーム をコメントアウトした --}}
{{-- タスク削除フォーム   'tasks.destroy' で　TasksController の destroyアクション へ行くようにしてる--}}

{{--  
{!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
--}}






 {{--   自分で a タグを記述しても良いですが、ここではLaravel Collectiveの link_to_route() 関数を利用しています。4つの引数について、まとめます。

第1引数：ルーティング名
第2引数：リンクにしたい文字列
第3引数：/tasks/{task} の {task} のようなURL内のパラメータに代入したい値を配列形式で指定（今回は不要なので空っぽの配列 []）
第4引数：HTMLタグの属性を配列形式で指定（今回はBootstrapのボタンとして表示するためのクラスを指定）
    
    --}}



@endsection
@extends('layouts.app')

@section('content')

{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
{{-- --}}
{{-- --}}

{{--  TasksController.php  の  Controller  から渡されたデータ ($tasks) を一覧表示させましょう。 --}}
{{-- Controller の TasksController.php の中の  index()メソッド では 　タスク一覧を取得して、それを　view関数を
 使って、第１引数に　'tasks.index' を指定している つまり、ここの resources/views/tasks/index.blade.php を意味します --}}

{{-- この  @section('content')   と　@endsection  の間に書かれた内容が、
 共通bladeファイルの app.blade.php の中の  @yield('content')  に　表示されます --}}

 <h1>メッセージ一覧</h1>

    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    
                    
                    
                    <th>ステータス</th>
                    
                    
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    
                    
                    {{-- タスク詳細ページへのリンク --}}
                    <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                    
                    
                    
                    <td>{{ $task->status }}</td>
                    
                    
                    
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- タスク作成ページへのリンク --}}
    {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary']) !!}

    @foreach ($tasks as $task)
        <tr>
            
    {{-- タスク詳細ページへのリンク aタグの代わりに --}}
    
  {{--   自分で a タグを記述しても良いですが、ここではLaravel Collectiveの link_to_route() 関数を利用しています。4つの引数について、まとめます。

第1引数：ルーティング名
第2引数：リンクにしたい文字列
第3引数：/tasks/{task} の {task} のようなURL内のパラメータに代入したい値を配列形式で指定（今回は不要なので空っぽの配列 []）
第4引数：HTMLタグの属性を配列形式で指定（今回はBootstrapのボタンとして表示するためのクラスを指定）
    
    --}}
    
    {{-- link_to_route() の第4引数（HTMLの属性情報）ですが今回は不要であるため、省略しています。 --}}
            <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
            <td>{{ $task->content }}</td>
        </tr>
    @endforeach


@endsection
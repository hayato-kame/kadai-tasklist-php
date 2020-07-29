@extends('layouts.app')

@section('content')

{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
{{-- --}}
{{-- --}}

{{-- この  @section('content')   と　@endsection  の間に書かれた内容が、
 共通bladeファイルの app.blade.php の中の  @yield('content')  に　表示されます --}}


{{-- 編集ページですので、$task の中には、それぞれのプロパティの値がもう入っています --}}


{{-- この後で、 'tasks.update' と指定しているとおり、 TasksControllerのupdateアクションにPOST送信される --}}


{{-- 連想配列にある 'route' => 'tasks.update' では、 'route' => ルーティング名 としてformタグのaction属性の設定を行っています。
action属性を 'tasks.update' としているのは、このPOSTメソッドのフォームを受け取って処理するのがTasksControllerのupdateアクションだからです。--}}


{{-- 連想配列にある $task->id  は、 $taskインスタンスの idプロパティの情報を次に行く　TasksControllerのupdateアクションに渡したいからです--}}

{{-- 第二引数の連想配列に 'method' => 'put' を追加 することが必要です  PUTメソッドやDELETEメソッドの場合には 'method' => 'put' や 'method' => 'delete' を付与することになります
'method' => 'post' だった時は、フォームを作成するときはデフォルトでPOSTメソッドになるので 書かなくても良いことになっています。
今回は、'method' => 'put'なので、必ず書きます。--}}

<h1>id: {{ $task->id }} のタスク編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
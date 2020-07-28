@extends('layouts.app')

@section('content')

{{-- コメントです --}}
 {{--  --}}
 {{--  --}}
{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}


{{-- TasksController の showアクションが実行されて ここに遷移してくる --}}

{{-- Viewに渡された $task にはレコード1件が格納されているため、それを使用して表示を行います。 --}}


{{--  --}}
 

 <h1>id = {{ $task->id }} のタスク詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $task->content }}</td>
        </tr>
    </table>

@endsection
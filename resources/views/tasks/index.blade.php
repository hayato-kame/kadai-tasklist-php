@extends('layouts.app')

@section('content')

{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
{{-- --}}
{{-- --}}

{{--  MessagesController.php  の  Controller  から渡されたデータ ($tasks) を一覧表示させましょう。 --}}
{{-- Controller の MessagesController.php の中の  index()メソッド では 　タスク一覧を取得して、それを　view関数を
 使って、第１引数に　'tasks.index' を指定している つまり、ここの resources/views/tasks/index.blade.php を意味します --}}

{{-- この  @section('content')   と　@endsection  の間に書かれた内容が、
 共通bladeファイルの app.blade.php の中の  @yield('content')  に　表示されます --}}

 <h1>メッセージ一覧</h1>

    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    

@endsection
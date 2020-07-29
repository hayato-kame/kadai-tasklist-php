@extends('layouts.app')

@section('content')

{{-- コメントです --}}
{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
 {{--  --}}
 {{--  --}}
 {{-- 下の  2重波かっこでびっくりマークの記法   は、Laravel Collectiveの関数やファサードが生成するHTMLを出力するやり方です 
   2重波かっこでびっくりマークの記法　は　htmlspecialchars関数に通さない やり方でうすが、
 Laravel Collectiveの関数やファサードは渡されたデータの無害化を内部で行うため、そのまま出力して問題ないからです --}}

{{-- Form::model() は第一引数に対象となるTaskのインスタンスを取り、第二引数は連想配列を取ります。
    連想配列にある 'route' => 'tasks.store' では、 'route' => ルーティング名 としてformタグのaction属性の設定を行っています。
    action属性を 'tasks.store' としているのは、このPOSTメソッドのフォームを受け取って処理するのが次に解説するTasksControllerのstoreアクションだからです。

また、第二引数の連想配列に 'method' => 'post' を追加しても良いですが、
フォームを作成するときはデフォルトでPOSTメソッドになるので今回は不要です（PUTメソッドやDELETEメソッドの場合には 'method' => 'put' や 'method' => 'delete' を付与することになります）。
--}}





{{-- バリデーションのエラーメッセージ 共通ファイルに書いたので コメントアウトにしておく--}}
<!--@if (count($errors) > 0)-->
<!--        <ul class="alert alert-danger" role="alert">-->
<!--            @foreach ($errors->all() as $error)-->
<!--                <li class="ml-4">{{ $error }}</li>-->
<!--            @endforeach-->
<!--        </ul>-->
<!--@endif-->


<h1>タスク新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($task, ['route' => 'tasks.store']) !!}

                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection


{{-- コメントです --}}
 {{--  --}}
 {{--  --}}
 {{-- Form::label() は
 第一引数に Form::model($task, ...) で指定されていたTaskモデルのインスタンスである $task のカラム（この場合 'content' カラム）を与え、
 第二引数にラベル名を与えます。 --}}
 
 
 {{-- Form::text() 
 の第一引数は Form::label() と同じく $task の 'content' カラムを指定します。
 --}}
 
 {{-- Form::text()
 は input type="text"を生成するための関数です。
 第二引数はテキストボックスに入れておきたい固定の初期値（不要ならnull）、
 第三引数はタグの属性情報を配列形式で指定します。 --}}
 
 {{-- 他にもinput要素を生成するための関数としては
 Form::password(), Form::email(), Form::select(), 
 Form::checkbox(), Form::radio() などその他にもあります。 --}}
 
 
 {{-- Form::submit('投稿') は
 送信ボタンを生成する関数で、
 第一引数にはボタンへ書かれる表示内容を与えます。
 送信すると、 
 Form::model($task, ['route' => 'tasks.store']) の route で指定されたaction属性へフォームの入力内容が送られます。 --}}


{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
{{-- --}}
{{-- --}}


{{-- 今ここではユーザ登録の機能を作ろうとしています。ModelとControllerは最初から用意されており、Routingの設定は先ほど行いました。 --}}

{{-- あとは用意されていない auth/ フォルダと register.blade.php を作成するだけでユーザ登録が動作します --}}

{{--  注意　今回は　ユーザー詳細画面や　ユーザー一覧画面 は要らない
--}}
{{-- OK  --}}






@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Sign up</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirmation') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection






{{--  この中に登場した old() 関数は、直前で入力していた値を再度代入できる関数です。たとえば、フォームで password と password_confirmation が一致しない状態で送信した場合、エラーとなってフォーム画面に戻ります。その際、すべて最初から入力し直してもらうのではなく、入力されていた内容を消さずに残しておけます（バリデーションを実装してから試してください）。ただし password 関係は old() で残さない方がセキュリティ的に良いでしょう。

ちなみに、このフォームはコード記載の通り、 signup.post のルーティング、つまり register() アクションに送信されます。そして register() の中ではログインも自動的に実行されます --}}

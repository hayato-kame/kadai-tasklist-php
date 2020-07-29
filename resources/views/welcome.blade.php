{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
{{-- --}}
{{-- --}}



{{-- あらかじめ書かれていた内容は不要であるため、すべて削除した OK --}}
{{-- ログインする前のウェルカムページ  トップページ --}}
{{--  OK --}}

{{-- トップページにユーザ登録リンクを作成しました--}}
{{--  OK --}}




@extends('layouts.app')

@section('content')


    @if (Auth::check())
        {{ Auth::user()->name }}
    @else


    
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the TaskList</h1>
                
            
            
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            
            
            
            </div>
        </div>
    
    
    @endif
    
    
@endsection
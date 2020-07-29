{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
{{-- --}}
{{-- --}}



{{-- あらかじめ書かれていた内容は不要であるため、すべて削除した OK --}}
{{-- ログインする前のウェルカムページ  トップページ --}}
{{--  OK --}}





@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the TaskList</h1>
        </div>
    </div>
@endsection
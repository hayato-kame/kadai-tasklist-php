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
 {{-- これをコメントにして 変更教科書9.3で --}}   
        <!--{{ Auth::user()->name }}-->
        
        
   
   <div class="row">
            <aside class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="card-body">
                        {{-- 認証済みユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                        <!--<img class="rounded img-fluid" src="{{ Gravatar::get(Auth::user()->email, ['size' => 500]) }}" alt="">-->
                    </div>
                </div>
            </aside>
            <div class="col-sm-8">
                {{-- 投稿一覧 --}}
                @include('tasks.tasks')
            </div>
        </div>
        
        
        
        
        
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the TaskList</h1>
     
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
   {{-- ページネーションのリンク includeするから  ここでは要らない --}}
    <!--{{ $tasks->links() }} -->
    @endif
@endsection
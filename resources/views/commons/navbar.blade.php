
{{-- コメントです --}}
{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
 {{--  --}}
 {{--  --}}


{{-- ユーザー登録ページへのリンクと　ログインページへのリンクに　差し替えた --}}
{{-- OK --}}


<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">TaskList</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            {{--1つ目の   ul  に mr-auto クラスを設定して内容は空っぽにしておくと、2つ目の  ul  に追加した  li  の内容はナビゲーションバーの右側に表示されます。--}}    

            
            
            <!--<ul class="navbar-nav">-->
            <!--    {{-- タスク作成ページへのリンク --}}-->
            <!--    <li class="nav-item">{!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'nav-link']) !!}</li>-->
            <!--</ul>-->
            
            
          
            
            <!--<ul class="navbar-nav">-->
            <!--    {{-- ユーザ登録ページへのリンク --}}-->
            <!--    <li class="nav-item"><a href="#" class="nav-link">Signup</a></li>-->
            <!--    {{-- ログインページへのリンク --}}-->
            <!--    <li class="nav-item"><a href="#" class="nav-link">Login</a></li>-->
            <!--</ul>-->
           
           
           
            
            {{-- ナビゲーションバーのSignupのリンクも正しいリンク先を設定しておきます  aタグじゃなくて link_to_route を使う--}}
            
            <ul class="nav navbar-nav navbar-right">
                    {{-- ユーザ登録ページへのリンク --}}
                    <li>{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li><a href="#">Login</a></li>
            </ul>
            
        
            
            
        </div>
    </nav>
</header>


{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}


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
            
            <!--<ul class="nav navbar-nav navbar-right">-->
            <!--        {{-- ユーザ登録ページへのリンク --}}-->
            <!--        <li>{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>-->
            <!--        {{-- ログインページへのリンク --}}-->
            <!--        <li><a href="#">Login</a></li>-->
            <!--</ul>-->
            
        
          
          
          
 {{-- ログインができるようになったため、ナビゲーションバーを充実させましょう。「Signup」「Login」のリンクはログアウト状態のときのみ表示するようにし、ログイン状態のときはログアウトできるようにします。 --}}         
          <ul class="navbar-nav">
                @if (Auth::check())
                
                
                
                {{-- ログアウトへのリンク --}}
                    <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                
                
                
                    {{-- ユーザ一覧ページへのリンク --}}
                    <!--<li class="nav-item"><a href="#" class="nav-link">Users</a></li>-->
                    <!--<li class="nav-item dropdown">-->
                    <!--    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>-->
                    <!--    <ul class="dropdown-menu dropdown-menu-right">-->
                    <!--        {{-- ユーザ詳細ページへのリンク --}}-->
                    <!--        <li class="dropdown-item"><a href="#">My profile</a></li>-->
                    <!--        <li class="dropdown-divider"></li>-->
                    <!--        {{-- ログアウトへのリンク --}}-->
                    <!--        <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>-->
                    <!--    </ul>-->
                    <!--</li>-->
               
               
               
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
          
          
            
            
        </div>
    </nav>
</header>


{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}


 {{-- ユーザ一覧、ユーザ詳細、 Gravatarの表示などは必要ありません --}}
  {{-- Bladeのファイル内で、条件によって表示内容を分けるために if-else 文を使いたいときは @if (条件式） ... @else ... @endif の指定をしてください。条件式に指定した Auth::check() は、ユーザがログインしているかどうかを調べるための関数です --}}


{{-- Authファサードについて   つまりはエイリアス    ニックネーム --}}
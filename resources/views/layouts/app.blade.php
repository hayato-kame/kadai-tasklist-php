<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>TaskList</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    </head>

    <body>
<!--        <header class="mb-4">-->
<!--            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">-->
<!--                {{-- トップページへのリンク --}}-->
<!--                <a class="navbar-brand" href="/">TaskList</a>-->

<!--                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">-->
<!--                    <span class="navbar-toggler-icon"></span>-->
<!--                </button>-->

<!--{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}-->
<!--{{-- bladeでは この波かっこを使用してコメントを書いてください --}}-->
 
<!--                <div class="collapse navbar-collapse" id="nav-bar">-->
                    
<!--                    <ul class="navbar-nav mr-auto"></ul>-->
<!--{{--1つ目の   ul  に mr-auto クラスを設定して内容は空っぽにしておくと、2つ目の  ul  に追加した  li  の内容はナビゲーションバーの右側に表示されます。--}}    -->
<!--                    <ul class="navbar-nav">-->
                        
<!--                                {{-- メッセージ作成ページへのリンク --}}-->
<!--                        <li class="nav-item">{!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'nav-link']) !!}</li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </nav>-->
<!--        </header>-->


{{-- ナビゲーションバー --}}
        @include('commons.navbar')


        <div class="container">
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
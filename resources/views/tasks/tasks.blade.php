{{--  .blade.php の拡張子のついたファイルでは、コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}
{{-- --}}
{{-- --}}




@if (count($tasks) > 0)
    <ul class="list-unstyled">
        @foreach ($tasks as $task)
            <li class="media mb-3">
                
    
                <div class="media-body">
                    <div>
                        
            
                        <span class="text-muted">posted at {{ $task->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        
                        {{-- ステータスを付け足した --}}
                        <p class="mb-0">{!! nl2br(e($task->status)) !!}</p>
                        
                        
                        <p class="mb-0">{!! nl2br(e($task->content)) !!}</p>
                    </div>
                    
                    
                    
                    {{-- 教科書9.5 で付け足した --}}
                    <div>
                        @if (Auth::id() == $task->user_id)
                        
                        
                            {{-- 投稿編集ボタンのフォーム を付け足した まず、TasksControllerのshowアクションへ行く その後でビューに行く (タスク詳細ビュー)--}}
                             {!! Form::open(['route' => ['tasks.show', $task->id], 'method' => 'get']) !!}
                                {!! Form::submit('Edit', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        
                        
                        
                        
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                    
                    
                    
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $tasks->links() }}
@endif



{{-- これをwelcomeの中で @include すれば、ログイン後のトップページに自分の投稿したTaskListが表示されるようになります。--}}
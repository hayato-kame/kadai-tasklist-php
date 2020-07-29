
{{-- コメントです --}}
 {{--  --}}
 {{--  --}}
{{--  コメントは　この波かっこの中に書くこと  --}}
{{-- bladeでは この波かっこを使用してコメントを書いてください --}}





{!! Form::open(['route' => 'tasks.store']) !!}

    <div class="form-group">
        
        {!! Form::label('status', 'ステータス:') !!}
        {!! Form::textarea('status', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
        
        {!! Form::label('content', 'タスク:') !!}
        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
        
        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}
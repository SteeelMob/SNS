@extends('layouts.login')

@section('content')

<div class="profile-content">
    <div class="profile-main">
<p>
@if($auth->images == "dawn.png")
            <img src="images/icon1.png" class="icon">
            @else
            <img src="storage/{{ $auth -> images }}" alt="icon" class="icon">
            @endif
</p>
</div>

<div class="profile-label">
    <p>
        
    </p>
    <p>
    {{ Form::label('username','user name') }}
    </p>
    <p>
    {{ Form::label('mail','mail') }}
    </p>
    <p>
    {{ Form::label('password','password') }}
    </p>
    <p>
    {{ Form::label('password_confirmation','password confirmation') }}
    </p>
    <p>
    {{ Form::label('bio','bio') }}
    </p>
    <p>
    {{ Form::label('images','images') }}
    </p>
</div>
{!! Form::open(['url' => ['/profile/{id}/update'],'files' => true]) !!}
{!! Form::hidden('id',$auth->id) !!}
@csrf

<!-- エラーメッセージ -->
<!-- <p>{{ $errors->count() }}</p> -->
@if($errors->any())
<div>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="profile-create">
<p>
{{ Form::text('username',$auth->username,['class' => 'input profile-info'] ) }}
</p>
<p>
{{ Form::text('mail',$auth->mail,['class' => 'input profile-info'] ) }}
</p>
<p>
{{ Form::text('password',null,['class' => 'input profile-info'] ) }}
</p>
<p>
{{ Form::text('password_confirmation',null,['class' => 'input profile-info'] ) }}
</p>
<p>
{{ Form::text('bio',$auth->bio,['class' => 'input profile-info']) }}
</p>
<p class= "file-form">
<label class="profile-file">
ファイルを選択
<input type="file" name="images" class="input form-control" style="display:none">
</label>
</p>
<p class="profile-submit">
{{ Form::submit('更新' , ['class' => 'profile-btn btn-danger']) }}
</p>

{!!Form::close()!!}
</div>

</div>

@endsection
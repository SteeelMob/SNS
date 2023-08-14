@extends('layouts.logout')

@section('content')

@if($errors->any())
<div >
    <ul class="vm" style="text-align:center;">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{!! Form::open(['url' => 'register' , 'class' => 'register-inner']) !!}

<p class ="register-front">新規ユーザー登録</p>
<!-- エラーメッセージ -->
<!-- <p>{{ $errors->count() }}</p> -->


{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::password('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('REGISTER',['class' =>'btn btn-danger btn-sm ']) }}

<p class ="login-back"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection

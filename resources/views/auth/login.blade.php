@extends('layouts.logout')

@section('content')

<div class = "login-inner">
{!! Form::open(['url' => '/login','class' => 'login-form']) !!}
<p class = "start">AtlasSNSへようこそ</p>


{{ Form::label('e-mail') }}
{{ Form::text('mail',null,['class' => 'input']) }}


{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('LOGIN',['class' =>'btn btn-danger btn-sm ']) }}

<p class = "create"><a href="/register">新規ユーザーの方はこちら</a></p>


{!! Form::close() !!}
</div>


@endsection
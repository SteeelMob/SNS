@extends('layouts.login')

@section('content')

{!! Form::open(['url' => ['/profile/{id}/update'],'method' => 'post']) !!}
{!! Form::hidden('id',$auth->id) !!}

<p>{{ Form::label('username','user name') }}</p>
<p>{{ Form::text('username',$auth->username ) }}</p>
<p>{{ Form::label('mail','mail') }}</p>
<p>{{ Form::label('password','password') }}</p>
<p>{{ Form::label('password_confirm','password confirm') }}</p>
<p>{{ Form::label('bio','bio') }}</p>

@endsection
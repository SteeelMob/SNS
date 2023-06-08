@extends('layouts.login')

@section('content')

<figure class="icon">
    <img src="{{ asset('/storage/' .$auth->image) }}" alt= "アイコン" class="icon">
</figure>

{!! Form::open(['url' => ['/profile/{id}/update'],'files' => true]) !!}
{!! Form::hidden('id',$auth->id) !!}
@csrf

<!-- エラーメッセージ -->
<p>{{ $errors->count() }}</p>
@if($errors->any())
<div>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<tr>
<td>
{{ Form::label('username','user name') }}
{{ Form::text('username',$auth->username,['class' => 'input'] ) }}
</td>
<td>
{{ Form::label('mail','mail') }}
{{ Form::text('mail',$auth->mail,['class' => 'input'] ) }}
</td>
<td>
{{ Form::label('password','password') }}
{{ Form::text('password',null,['class' => 'input'] ) }}
</td>
<td>
{{ Form::label('password_confirmation','password confirmation') }}
{{ Form::text('password_confirmation',null,['class' => 'input'] ) }}
</td>
<td>
{{ Form::label('bio','bio') }}
{{ Form::text('bio',$auth->bio,['class' => 'input']) }}
</td>
<td>
{{ Form::label('images','images') }}
{{ Form::file('images',['class'=>'input form-control']) }}
</td>
<td>
{{ Form::submit('更新') }}
</td>
</tr>
{!!Form::close()!!}

@endsection
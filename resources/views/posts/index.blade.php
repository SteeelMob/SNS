@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう</h2>

<!--投稿フォーム-->
<div class='container'>
    <h2 class ="page-header">投稿一覧</h2>
    <img src="images/icon1.png">
    {!! Form::open(['url' => '/create']) !!}
    <div class="form-group">
        {!! Form::text ('newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
       </div>
       <button type="submit" class="btn btn-success pull-right"><img src="images/post.png"></button>
       {!! Form::close()!!}

      <table class="table table-hover"> <!--テーブル列にマウスを乗せた際に背景変更するもの-->
       @foreach ($list as $list)
       <tr>
        <td>{{ $list ->user ->username }}</td>
        <td>{{ $list ->post }}</td>
        <td>{{ $list ->created_at }}</td> 
       </tr>
       @endforeach
       </table>



</div>

{{ Form::close() }}

@endsection
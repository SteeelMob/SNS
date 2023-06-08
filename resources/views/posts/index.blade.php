@extends('layouts.login')<!--ログインブレードに共通化されているから-->

@section('content')
<h2>機能を実装していきましょう</h2>

<!--投稿フォーム-->
<div class='container'>
    <h2 class ="page-header">投稿一覧</h2>
    @if($auth->images == null)
    <img src="images/icon1.png">
    @else
    <img src="{{ asset('/storage/' .$auth->images) }}" alt= "アイコン" class="icon">
    @endif
    {!! Form::open(['url' => '/create']) !!}
    <div class="form-group">
        {!! Form::text ('newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
       </div>
       <button type="submit" class="btn btn-success pull-right"><img src="images/post.png"></button>
       {!! Form::close()!!}

      <table class="table table-hover"> <!--テーブル列にマウスを乗せた際に背景変更するもの-->
       @foreach ($list as $list)
       <tr>
        <td>
        @if($list->images == null)
        <img src="images/icon1.png">
        @else
        <img src="{{ asset('/storage/' .$list->images) }}" alt= "アイコン" class="icon">
        @endif
        </td>
        <td>{{ $list ->user ->username }}</td>
        <td>{{ $list ->post }}</td>
        <td>{{ $list ->created_at }}</td>
        <!--更新用-->
        <td><div class="content">
            <a class="js-modal-open" href="" post="{{$list ->post }}" post_id="{{ $list->id }}">
            <img class="Update" src="./images/edit.png" alt="編集" />
            </a></div>
        </td>
        <!--消去用-->
        <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('この投稿を消去します。よろしいでしょうか？')">
        <img class="Trash" src="./images/trash.png" alt="消去" /></a>
        </td>
       </tr>
       @endforeach
       </table>

       <!--モーダル-->
       <div class="modal js-modal">
        <div class="modal_bg js-modal-close"></div>
        <div class="modal_content">
            <form action="/post/update" method="POST">
                <textarea name="upPost" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <input type="submit" value="更新">
                {{ csrf_field() }}
            </form>
            <a class="js-modal-close" href="">閉じる</a>
        </div>
       </div>




</div>

{{ Form::close() }}

@endsection
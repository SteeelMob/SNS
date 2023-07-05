@extends('layouts.login')<!--ログインブレードに共通化されているから-->

@section('content')

<!--投稿フォーム-->
<div class='container'>
<div class="form-group">
    @if($auth->images == "dawn.png")
    <img src="images/icon1.png" class="icon">
    @else
    <img src="{{ asset('/storage/' .$auth->images) }}" alt= "アイコン" class="icon">
    @endif
    {!! Form::open(['url' => '/create','class' => 'form-inner']) !!}
    @csrf
        {!! Form::textarea ('newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
        <button type="submit" class="btn-success"><img src="images/post.png"></button>
       {!! Form::close()!!}
       </div>

       <!--テーブル列にマウスを乗せた際に背景変更するもの-->
       @foreach ($list as $list)
       <div class="table table-hover">
       <!-- <ul> -->
        <p class="table-top">
        @if($list->user->images == "dawn.png")
        <img src="images/icon1.png" class="icon">
        @else
        <img src="{{ asset('/storage/' .$list->user->images) }}" alt= "アイコン" class="icon">
        @endif
        </p>
        <div class="table-name">
        <p class ="table-user">{{ $list ->user ->username }}</p>
        <p class ="table-post">{{ $list ->post }}</p>
        </div>
        <div class="table-create">
        <p class ="table-time">{{ $list ->created_at }}</p>
        <!--更新用-->
        @if($list->user->id == "$auth->id")
        <div class="content">
            <a class="js-modal-open" href="" post="{{$list ->post }}" post_id="{{ $list->id }}">
            <img class="Update" src="./images/edit.png" alt="編集" />
            </a>
       
        <!--消去用-->
        <div class="btn-trash">
        <a href="/post/{{$list->id}}/delete" onclick="return confirm('この投稿を消去します。よろしいでしょうか？')">
        <img class="Trash-h" src="./images/trash-h.png" alt="消去" />
        <img class="Trash" src="./images/trash.png" alt="消去" />
        </a>
        </div>
       </div>
       @endif
       </div>
       <!-- </ul> -->
       </div>
       @endforeach
       

       <!--モーダル-->
       <div class="modal js-modal">
        <div class="modal-bg js-modal-close"></div>
        <div class="modal-content">
            <form action="/post/update" method="POST">
                <textarea name="upPost" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <button type="submit" class="btn-up"><img class="Update" src="./images/edit.png" alt="編集" /></button>
                {{ csrf_field() }}
            </form>
            <!-- <a class="js-modal-close" href="">閉じる</a> -->
        </div>
       </div>




</div>

{{ Form::close() }}

@endsection
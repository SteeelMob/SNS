@extends('layouts.login')

@section('content')

<div class="userpro-content">
        <p class="userpro-top">
        @if($list->images == "dawn.png")
        <img src="{{ asset('images/icon1.png') }}" class="icon">
        @else
        <img src="{{ asset('storage/' .$list->images) }}" alt= "アイコン" class="icon">
        @endif
        </p>
        <div class="userpro-title">
    <p>name</p>
    <p>bio</p>
    </div>
    <div class="userpro-text">
    <p>{{ $list->username }}</p>
    <p>{{ $list->bio }}</p>
    </div>
    <div class="userpro-btn">
    <p>
    @if(auth()->user()->isFollowing($list->id))
            <form action="{{ route('unfollow', ['user' => $list->id]) }}" method="POST">
                 @csrf
                 {{ method_field('DELETE') }}
                 <button type="submit" class="user-btn btn-danger">フォロー解除</button>
            </form>
            @else
            <form action="{{ route('follow',  ['user' => $list->id]) }}" method="POST">
                 @csrf
                 <button type="submit" class="user-btn btn-primary">フォローする</button>
                </form>
            @endif
    </p>
    </div>
</div>

@foreach ($post as $post)
<div class="table-follow">
        <p class="table-top">
        @if($post->user->images == "dawn.png")
        <img src="{{ asset('images/icon1.png') }}" class="icon">
        @else
        <img src="{{ asset('/storage/' .$post->user->images) }}" alt= "アイコン" class="icon">
        @endif
        </p>
        <div class="table-followname">
        <p class="follow-user">{{ $post ->user ->username }}</p>
        <p class="follow-post">{{ $post ->post }}</p>
        </div>
        <p class="follow-time">{{ $post ->created_at }}</p>
</div>
@endforeach

@endsection
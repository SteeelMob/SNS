@extends('layouts.login')

@section('content')
<div class="follow-list">
    <p class="follow-title">Follower List</p>
    @foreach($images as $images)
    <a href="{{ route('userprofile',$images->id) }}">
        @if($images ->id !== Auth::user()->id && $images->images == "dawn.png")
        <img src="images/icon1.png" class="icon">
        @elseif($images ->id !== Auth::user()->id)
         <img src="{{ asset('/storage/' .$images->images) }}" alt= "アイコン" class="icon">
        @endif
        </a>
    @endforeach
</div>
<div class= "clm_bottom follower_post_timeline">
    @foreach($list as $list)
    <div class= "table-follow">
        <p class="table-top"><a href="{{ route('userprofile',['id' => $list->user_id]) }}">
        @if($list->user->images == "dawn.png")
        <img src="images/icon1.png" class="icon">
        @else
        <img src="{{ asset('/storage/' .$list->user->images) }}" alt= "アイコン" class="icon">
        @endif
        </a>
        </p>
        <div class="table-followname">
        <p class="follow-user">{{ $list->user->username }}</p>
        <p class="follow-post">{{ $list->post }}</p>
</div>
        <p class="follow-time">{{ $list->created_at }}</p>
</div>
    @endforeach
</div>
@endsection
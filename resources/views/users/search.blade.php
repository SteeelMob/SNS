@extends('layouts.login')

@section('content')

<div class="search-form">
  <form action="{{ route('users.search') }}" method="GET" class="search-container">
    <input type="text" name="keyword" value="" placeholder="ユーザー名" class="search-text">
    <!-- <input type="submit" value="検索"> -->
    <button type="submit" class="search-click"><img src="images/search.jpg" class="search-img"></button>
    @if(!empty($keyword))
    <p class="word-key">検索ワード：{{ $keyword }}</p>
    @endif
  </form>
</div>

<!-- {!! Form::open(['url' => 'users.search', 'class' => 'post-form']) !!}
{{ Form::input('text', 'searchWord', null, ['required', 'class' =>'search', 'placeholder' =>'ユーザー名']) }}
<button type="submit"><img src="images/post.png" width="100" height="100"></button>
@if(!empty($searchWord))
<div class="search-word">
    検索ワード:{{ $searchWord }}
</div>
@endif
{!! Form::close() !!} -->
<div class="search-inner">
@foreach($users as $users)

    <div class="search-list">
        <p>
            @if($users->images == "dawn.png")
            <img src="images/icon1.png" class="icon">
            @else
            <img src="storage/{{ $users -> images }}" alt="icon" class="icon">
            @endif
        </p>
        <p class ="search-name">{{ $users -> username }}</p>
        <p class ="search-btn">
            @if(auth()->user()->isFollowing($users->id))
            <form action="{{ route('unfollow', ['user' => $users->id]) }}" method="POST">
                 @csrf
                 {{ method_field('DELETE') }}
                 <button type="submit" class="search-follow btn btn-danger" style = "font-size: small;">フォロー解除</button>
            </form>
            @else
            <form action="{{ route('follow',  ['user' => $users->id]) }}" method="POST">
                 @csrf
                 <button type="submit" class="search-follow btn btn-primary" style = "font-size: small;">フォローする</button>
                </form>
            @endif
        </p>
        </div>
@endforeach
</div>


@endsection
@extends('layouts.login')

@section('content')

<div>
  <form action="{{ route('users.search') }}" method="GET">
    <input type="text" name="keyword" value="{{ $keyword }}">
    <input type="submit" value="検索">
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

@foreach($users as $users)
<div>
    <tr>
        <td>
            <img src="storage/{{ $users -> images }}" alt="icon" class="icon-space">
        </td>
        <td>{{ $users -> username }}</td>
        <td>
            @if(auth()->user()->isFollowing($users->id))
            <form action="{{ route('unfollow', ['user' => $users->id]) }}" method="POST">
                 @csrf
                 {{ method_field('DELETE') }}
                 <button type="submit" class="btn btn-danger">フォロー解除する</button>
            </form>
            @else
            <form action="{{ route('follow',  ['user' => $users->id]) }}" method="POST">
                 @csrf
                 <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
            @endif
        </td>
    </tr>
</div>
@endforeach


@endsection
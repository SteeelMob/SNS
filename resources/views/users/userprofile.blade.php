@extends('layouts.login')

@section('content')
<h2>プロフィール</h2>

<tr>
<td>
        @if($list->images == null)
        <img src="images/icon1.png">
        @else
        <img src="{{ asset('/storage/' .$list->images) }}" alt= "アイコン" class="icon">
        @endif
        </>
</td>
</tr>
<tr>
    <td>name</td>
    <td>{{ $list->username }}</td>
    <td>
    @if(auth()->user()->isFollowing($list->id))
            <form action="{{ route('unfollow', ['user' => $list->id]) }}" method="POST">
                 @csrf
                 {{ method_field('DELETE') }}
                 <button type="submit" class="btn btn-danger">フォロー解除する</button>
            </form>
            @else
            <form action="{{ route('follow',  ['user' => $list->id]) }}" method="POST">
                 @csrf
                 <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
            @endif
    </td>
</tr>

@foreach ($post as $post)
<tr>
        <td>
        @if($post->images == null)
        <img src="images/icon1.png">
        @else
        <img src="{{ asset('/storage/' .$post->images) }}" alt= "アイコン" class="icon">
        @endif
        </td>
        <td>{{ $post ->user ->username }}</td>
        <td>{{ $post ->post }}</td>
        <td>{{ $post ->created_at }}</td>
</tr>
@endforeach

@endsection
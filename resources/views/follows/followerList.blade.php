@extends('layouts.login')

@section('content')
<div class="follower_list">
    <h2>フォロワーリスト</h2>
</div>
<div class= "clm_bottom follower_post_timeline">
    @foreach($list as $list)
    <tr>
        <td>{{ $list->user->username }}</td>
        <td>{{ $list->created_at }}</td>
        <td>{{ $list->post }}</td>
    </tr>
    @endforeach
</div>
@endsection
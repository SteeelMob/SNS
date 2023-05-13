@extends('layouts.login')

@section('content')

<div class="follow_list">
    <h2>フォローリスト</h2>
</div>
<div class= "clm_bottom post_timeline">
    @foreach($list as $list)
    <tr>
        <td>{{ $list->user->username }}</td>
        <td>{{ $list->created_at }}</td>
        <td>{{ $list->post }}</td>
    </tr>
    @endforeach
</div>

@endsection
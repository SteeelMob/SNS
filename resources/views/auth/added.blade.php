@extends('layouts.logout')

@section('content')

<div id="clear" class="add-inner">
  <!--sessionでpタグはさんで名前を取得する---->
  @if(session('username'))
  <p class="add-user"> {{ session('username')}}さん</p>
  @endif
  <p class="add-welcome">ようこそ！AtlasSNSへ！</p>
  <p class="add-text">ユーザー登録が完了いたしました。
    <br>早速ログインをしてみましょう！
    <!-- brで改行 -->
  </p>
  
<div class="added-btn">
  <p class="back-btn btn btn-danger btn-sm w-50"><a href="/login">ログイン画面へ</a></p>
  </div>
</div>

<!--テスト6-->

@endsection

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- css -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!--CSSのBootstrap 記述は共通ファイルのhead内の下-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- cssのfont awesome 利用 -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <!-- jQueryはヘッダー内へ -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <header>
      <div id = "head">
        <div class ="header-top">
            <h1><a href="/top"><img src="{{asset('images/atlas.png')}}"></a></h1>
             <div id="accordion" class="accordion-container">
                    <div class ="accordion-title js-accordion-title">
                    <p>{{ Auth::user()->username }}さん</p>
                    <p class="accordion-point"></p>
                    <p class="acc-img">
                    @if($auth->images == "dawn.png")
                    <img src="{{asset('images/icon1.png')}}" class="icon">
                    @else
                    <img src="{{ asset('/storage/' .$auth->images) }}" alt= "アイコン" class="icon">
                    @endif
                    </p>
                    </div>
                    <!-- <button type="button" class="menu-btn">
                        <span class="inn"></span>
                    </button>
                    <nav class="menu"> -->
             <div class="accordion-content">
                <ul class="accordion-list">
                    <li class="accordion-btn"><a href="/top">HOME</a></li>
                    <li class="accordion-btnn"><a href="/profile">プロフィール編集</a></li>
                    <li class="accordion-btnnn"><a href="/logout">ログアウト</a></li>
                </ul>
                </div>
                <!-- <figure class="icon">
                <img src="images/arrow.png">
                </figure> -->
                
                <!-- </nav> -->
            </div> 
        </div>
     </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p class="side-name">{{ Auth::user()->username }}さんの</p>
                <div class="count">
                <p>フォロー数</p>
                <p>{{ Auth::user()->following()->count() }}名</p>
                </div>
                <button type="button" class="side-btn btn-primary side-btn"><a href="/followList">フォローリスト</a></button>
                <div class="count">
                <p>フォロワー数</p>
                <p>{{ Auth::user()->followed()-> count() }}名</p>
                </div>
                <button type="button" class="side-btn btn-primary side-btn"><a href="/followerList">フォロワーリスト</a></button>
            </div>
            <button type="button" class="search-btn  btn-primary "><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
    <!--JavaScriptのBootstrap のCDN 共通ファイルのHTML　body内に入れる必要がある--><!--CDNとは　オンラインで外部のサービスを利用できるシステム-->

   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
       integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
       crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
       integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
       crossorigin="anonymous"></script>
</body>
</body>
</html>

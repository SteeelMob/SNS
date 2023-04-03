<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Postモデルを使用
use App\Post;
use App\User;
use Auth;
//use Illuminate\Support\Facades\Auth; //もともとlaravelにあるAuthを使うため記述

class PostsController extends Controller
{
    //投稿フォームを画面に表示
    public function index()
    {
        // $list = Post::get();
        // $list = \DB::table('posts') -> get(); //データベースから直で引っ張る
        // $user = Auth::user(); //ログインしているデーター取得 //Authの部分がクラス
        $list =Post::with('Users')-> get('id'); //追加 getのかっこにid入れるか入れないか
        return view('posts.index',['list'=>$list]); //['post'=>$list]を追加 ページ移動するときに作った変数をここに入れないと送れない！
        //    return view('posts.index');
        $list = Auth::user();
          //書き直し
    }

    //つぶやき登録
    public function create(Request $request)
    {
        $post = $request->input('newPost'); //ブレードで記入したものを入れ込むため
        $user = Auth::user()->id; //ユーザーの値を
        //insertで入れ込む　テーブルに値を変数化するために記入　上記２行でその変数の中身指定
        \DB::table('posts')->insert([
            'post' =>$post,
            'user_id' => $user
        ]);

        return redirect('top');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Postモデルを使用
use App\Post;
use App\User;
use DB;
use Auth;
//use Illuminate\Support\Facades\Auth; //もともとlaravelにあるAuthを使うため記述

class PostsController extends Controller
{
    //投稿フォームを画面に表示
    public function index()
    {
        // $list = Post::orderBy('created_at','desc') ->get();
        // // $list = \DB::table('posts') -> get(); //データベースから直で引っ張る
        // // $user = Auth::user(); //ログインしているデーター取得 //Authの部分がクラス
        // // $list =Post::with('Users')-> get(); //追加 getのかっこにid入れるか入れないか
        // return view('posts.index',['list'=>$list]); //['post'=>$list]を追加 ページ移動するときに作った変数をここに入れないと送れない！
        // //    return view('posts.index');
        // $list = Auth::user();
          //書き直し
        //   $following_id = Auth::user()->follows()->pluck('followed_id');
        //   $list = Post::with('user')->whereIn('posts.user_id', $following_id)->get();
          $list = Post::query()->whereIn('posts.user_id', Auth::user()->following()->pluck('followed_id'))->orWhere('user_id', Auth::user()->id)->latest()->get();
//  Post：：query()　ポストモデルの中の
// whereIn('user_id')　user_idが
// Auth::user()->follows()->pluck('followed_user_id')　自分がフォローしているユーザーの中でフォロワーが自分であるユーザーを取得して
// latest()->get()　最新順に取得する
          $auth = Auth::user();
          return view('posts.index', ['list'=>$list , 'auth' => $auth , ]);
    }

    //フォローリストに投稿フォーム表示
    public function followList()
    {
        $list = Post::query()->whereIn('posts.user_id', Auth::user()->following()->pluck('followed_id'))->latest()->get();
        $auth = Auth::user();
        // $follow_user = $auth ->following() ->get();
        // $follow_user = Post::query()->whereIn('posts.users.id' , Auth::user()->following()->pluck('followed_id'))->latest()->get();
        // アイコン用
        $images = DB::table('users')->get();
        $images = auth()->user()->following()->get();
        return view('follows.followList', ['list' =>$list ,'auth' => $auth , 'images' => $images]);
    }
    // public function followIcon(){
    //     $follow_user = Auth::user()->following()->pluck('followed_id') ->get();
    //     dd($follow_user);
    //     return view('follows.followList',['follow_user'=>$follow_user]);
    // }

    //フォロワーリストに投稿フォーム表示
    public function followerList()
    {
        $list = Post::query()->whereIn('posts.user_id', Auth::user()->followed()->pluck('following_id'))->latest()->get();
        $auth = Auth::user();
        // アイコン用
        $images = DB::table('users')->get();
        $images = auth()->user()->followed()->get();
        return view('follows.followerList', ['list' =>$list , 'auth' => $auth , 'images' => $images]);
    }
    //フォロー数


    //つぶやき登録
    public function create(Request $request)
    {
        $post = $request->input('newPost'); //ブレードで記入したものを入れ込むため
        $user = Auth::user()->id; //ユーザーの値を

        Post::create([ //posttableを参照させてみる　
            'user_id' =>$user,
            'post' => $post
        ]);

        //insertで入れ込む　テーブルに値を変数化するために記入　上記２行でその変数の中身指定
        // \DB::table('posts')->insert([
        //     'post' =>$post,
        //     'user_id' => $user
        // ]);

        return redirect('top');
    }

    //編集
    public function update(Request $request)
    {
        $id = $request ->input('id');
        $up_post = $request->input('upPost');
        // $post = \DB::table('posts')->where('id',$request->id)->update(['post' =>$up_post]);

        // return redirect('/top');
        //最初のレコードを返すメソッド　単一の取得の時にfirstを使う
        Post::where('id' , $id)->update(['post' => $up_post]);
        return redirect('top');
    }

    //消去
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('top');
    }


}

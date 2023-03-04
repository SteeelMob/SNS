<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Authファサードを読み込ませるため
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    //認証の試行を処理らしい...
   // public function login(Request $request)
    //{
       // $user_info = $request ->validate([
           // 'email' => ['required','email'],
           // 'password' => ['required']
       // ]);

        //ログイン成功時
        //if (Auth::attempt($user_info)){
           // $request ->session() ->regenerate();
           // return redirect() ->route('posts/index');
       // }

        //ログイン失敗
       // return redirect() ->back();
    //}
}

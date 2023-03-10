<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //もともとlaravelにあるAuthを使うため記述

class PostsController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user(); //ログインしているデーター取得 //Authの部分がクラス
        
        return view('posts.index');
    }
}

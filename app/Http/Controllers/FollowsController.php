<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
         //フォローしてるか
         $is_following = $follower->isFollowing($user->id);
         if(!$is_following)
         {
            //フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
         }
    }

    //フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        //フォローしてるか
        $is_following = $follower->isFollowing($user->id);
        if($is_following)
        {
            //フォローしていなければ解除
            $follower->unfollow($user->id);
            return back();
        }
    }
}

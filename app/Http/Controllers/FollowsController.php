<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Follow;
use App\Post;


class FollowsController extends Controller
{
    
    // public function followIcon(){
        // $user = Auth::user();
        // $follow_user = Follow::join('users','follows.followed_id','=','users.id')->where('following_id',Auth::User()->id) ->get();
        // $follow_user = auth()->user()->following()->get();
        // dd($follow_user);
        // return view('follows.followList',['follow_user'=>$follow_user]);
    // }
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

    // //フォローリスト
    // public function followList(Post $post, User $user, Follow $follower)
    // {
    //     $following = auth()->user()->following()->get();
    //     $following_id = $follower->followingId($user->id);
    //     $following
    // }




}

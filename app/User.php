<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;


class User extends Authenticatable
{
        //post_tableとのリレーション
        public function posts()  //こっちは多なので複数
        {
            return $this->hasMany(Post::class);
        }

    use Notifiable;

    //フォロー機能
    public function following()
    {
        return $this ->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }
    //フォロー解除
    public function followed()
    {
        return $this->belongsToMany(User::class, 'follows', 'follows', 'following_id','followed_id');
    }
    //フォローする 
    public function follow(Int $user_id)
    {
        //上記メソッドとそろえる
        return $this->following()->attach($user_id);
    }
    //フォロー解除する
    public function unfollow($user_id)
    {
        return $this->following()->detach($user_id);
    }
    //フォローしてるか
    public function isFollowing($user_id)
    {
        return(boolean) $this->following()->where('followed_id', $user_id)->first();
    }
    //フォローされているか
    public function isFollowed($user_id)
    {
        return(boolean) $this->followed()->where('following_id', $user_id)->first();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}

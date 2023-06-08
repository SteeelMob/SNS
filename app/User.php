<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
use App\Follow;


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
        return $this ->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
//  第一引数には使用するモデル
// 第二引数には使用するテーブル名
// 第三引数にはリレーションを定義しているモデルの外部キー名 （取得したい情報）
// 第四引数には結合するモデルの外部キー名 （あまりものを）
    }
    //フォロー解除
    public function followed()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id','following_id');
    }
    //フォローする 
    public function follow(Int $user_id)
    {
        //上記メソッドとそろえる
        return $this->following()->attach($user_id);
    }
    //フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->following()->detach($user_id);
    }
    //フォローしてるか
    public function isFollowing(Int $user_id)
    {
        return(boolean) $this->following()->where('followed_id', $user_id)->first();
    }
    //フォローされているか
    public function isFollowed(Int $user_id)
    {
        return(boolean) $this->followed()->where('following_id', $user_id)->first();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password','images'
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

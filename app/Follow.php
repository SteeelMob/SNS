<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Follow extends Model
{
    //中間テーブルでフォロー機能
    // protected $fillable =['user_id','follower_id'];
    protected $fillable =['following_id', 'followed_id'];
}

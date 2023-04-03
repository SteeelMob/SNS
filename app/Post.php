<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //投稿フォーム作成時記入
    protected $fillable =[
        'post','user_id',
    ];

    //user_tableとリレーション
    public function user() //こっちが１対多　の１なので単数
    {
        return $this ->belongsTo('App\User');
    }

}

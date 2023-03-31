<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //投稿フォーム作成時記入
    protected $fillable =[
        'post','user_id',
    ];
    
    //user_tableとリレーション
    public function Users()
    {
        return $this ->belongsTo('App\User');
    }

}

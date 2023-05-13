<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Auth;

class UsersController extends Controller
{
    //
    // public function search(Request $request)
    // {
    //      $users = User::get();
    //      $searchWord =$request->input('searchWord');
    //      return view('users.search')->with(['users' => $users, 'searchWord' => $searchWord]);
         
    // }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = User::query();

        if(!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }

        $users = $query->get();

        return view('users.search', compact('users', 'keyword'));
    }

    //プロフィール
    public function profile()
    {
        $auth = Auth::user();
        return view('users.profile', ['auth' => $auth] );
    }
    public function bio(array $data)
    {
        return User::create([
            'bio' => $data['bio'],
        ]);
    }

        //編集 ここからいじる
        public function update(Request $request)
        {
            $id = $request ->input('id');
            $username  = $request->input('username');
            $mail  = $request->input('mail');
            $password = $request->input('password');
            $bio = $request->input('bio');

            // $post = \DB::table('posts')->where('id',$request->id)->update(['post' =>$up_post]);
    
            // return redirect('/top');
            //最初のレコードを返すメソッド　単一の取得の時にfirstを使う
            User::where('id' , $id)->update(
                ['username' => $username],
                ['mail' => $mail],
                ['password' =>bcrypt($password)],
                ['bio' => $bio ],
            );
            return redirect('profile');
        }

}


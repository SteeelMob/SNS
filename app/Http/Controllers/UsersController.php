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
            // $id = $request ->input('id');
            // $username  = $request->input('username');
            // $mail  = $request->input('mail');
            // $password = $request->input('password');
            // $bio = $request->input('bio');

            // User::where('id' , $id)->update(
            //     ['username' => $username],
            //     ['mail' => $mail],
            //     ['password' =>bcrypt($password)],
            //     ['bio' => $bio ],
            // );
            // return redirect('top');

            $user = Auth::user();
            //画像登録 アイコンはシンボリックリンク使用
            $image = $request->file('images')->store('public/storage');
            // $validator->validate();
            $user->update([
                'username' => $request->input('username'),
                'mail' => $request->input('mail'),
                'password' => bcrypt($request->input('password')),
                'bio' => $request->input('bio'),
                'images' => basename($image),
            ]);

            return redirect('top');

        }

}


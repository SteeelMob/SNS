<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Follow;
use App\Post;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;

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
        // ->where("id" , "!=" , Auth::user()->id)->paginate()

        if(!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }

        $users = $query->where("id" , "!=" , Auth::user()->id)->get();

        $auth = Auth::user();

        return view('users.search', compact('users', 'keyword','auth'));
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
            //バリデーション
            if($request->isMethod('post')){
                $rules =[
                    'username' => 'required|string|min:2|max:12',
                    'mail' => 'required|string|email|min:5|max:40|unique:users',
                    'password' => 'required|string|min:8|max:20|alpha_dash|confirmed',
                    'password_confirmation' => 'required|string|min:8|max:20|alpha_dash',
                    'bio' => 'max:150',
                    'images' => 'required|image|mimes:jpg,png,bmp,gif,svg',
                ];

                $message = [
                    'username.required' => 'ユーザー名を入力してください',
                    'username.min' => 'ユーザー名は2文字以上、12文字以下で入力してください',
                    'username.max' => 'ユーザー名は2文字以上、12文字以下で入力してください',
                    'mail.required' =>'メールアドレスを入力してください',
                    'mail.email' =>'有効なEメールアドレスを入力してください',
                    'mail.min' =>'メールアドレスは5文字以上、40文字以下で入力してください',
                    'mail.max' =>'メールアドレスは5文字以上、40文字以下で入力してください',
                    'mail.unique:users' =>'このメールアドレスは既に使われております',
                    'password.required' => 'パスワードを入力してください',
                    'password.min' => 'パスワードは8文字以上、20文字以下で入力してください',
                    'password.max' => 'パスワードは8文字以上、20文字以下で入力してください',
                    'password.alpha_dash' => 'パスワードは英数字のみで入力してください',
                    'password.confirmed' => '確認パスワードが一致してません',
                    'password_confirmation.required' =>'確認パスワードを入力してください',
                    'password_confirmation.alpha_dash' =>'パスワードは英数字のみで入力してください',
                    'images.image' =>'指定されたファイルは画像ではありません',
                    'images.mimes' =>'指定されたファイルではありません',
                ];
    
                $validator =Validator::make($request->all(),$rules,$message);
                if($validator->fails()){
                    return redirect('profile')
                    ->withErrors($validator)
                    ->withInput();
                }
            }
            $id = $request ->input('id');
            $username  = $request->input('username');
            $mail  = $request->input('mail');
            $password = bcrypt($request->input('password'));
            $bio = $request->input('bio');
            $images = $request-> file('images')->store('storage','public');
            // dd($images);


            \DB::table('users')
            ->where('id', $id)
            ->update([
                'username' => $username,
                'mail' => $mail,
                'password' => $password,
                'bio' => $bio,
                'images' => $images
                ]);
            // return redirect('top');

            // $user = Auth::user();
            // //画像登録 アイコンはシンボリックリンク使用
            // $image = $request->file('images')->store('public/storage');
            // // $validator->validate();
            // $user->update([
            //     'username' => $request->input('username'),
            //     'mail' => $request->input('mail'),
            //     'password' => bcrypt($request->input('password')),
            //     'bio' => $request->input('bio'),
            //     'images' => basename($image),
            // ]);

            return redirect('top');

        }

        //他のユーザープロフィール
        public function userProfile($id)
        {
            $list = User::where('id',$id)->first();
            $post =Post::with("user")->where('user_id',$id)->get();
            $auth = Auth::user();

            return view('users.userprofile',compact('list','post','auth'));
        }

}


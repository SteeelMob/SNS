<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'username' => 'required|string|max:255',
    //         'mail' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:4|confirmed',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([ //returnを$userに変更
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
        //ユーザー名をセッションに保存 createがある場所じゃなきゃ×
        session()->flash('username',$user ->username);
        return $user;
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

     //バリデーション
    //  if($data->isMethod('post')){
    //     $rules =[
    //         'username' => 'required|string|min:2|max:12',
    //         'mail' => 'required|string|email|min:5|max:40|unique:users',
    //         'password' => 'required|string|min:8|max:20|alpha_dash|confirmed',
    //     ];

    //     $message = [
    //         'username.required' => 'ユーザー名を入力してください',
    //         'username.min' => 'ユーザー名は2文字以上、12文字以下で入力してください',
    //         'username.max' => 'ユーザー名は2文字以上、12文字以下で入力してください',
    //         'mail.required' =>'メールアドレスを入力してください',
    //         'mail.email' =>'有効なEメールアドレスを入力してください',
    //         'mail.min' =>'メールアドレスは5文字以上、40文字以下で入力してください',
    //         'mail.max' =>'メールアドレスは5文字以上、40文字以下で入力してください',
    //         'mail.unique:users' =>'このメールアドレスは既に使われております',
    //         'password.required' => 'パスワードを入力してください',
    //         'password.min' => 'パスワードは8文字以上、20文字以下で入力してください',
    //         'password.max' => 'パスワードは8文字以上、20文字以下で入力してください',
    //         'password.alpha_dash' => 'パスワードは英数字のみで入力してください',
    //         'password.confirmed' => '確認パスワードが一致してません',
    //     ];

    //     $validator =Validator::make($data->all(),$rules,$message);
    //     if($validator->fails()){
    //         return redirect('register')
    //         ->withErrors($validator)
    //         ->withInput();
    //     }
    // }

    public function register(Request $request){//inputしている値を使える
        if($request->isMethod('post')){
            $data = $request->input();

            //バリデーション
            $rules =[
                'username' => 'required|string|min:2|max:12',
                'mail' => 'required|string|email|min:5|max:40|unique:users',
                'password' => 'required|string|min:8|max:20|alpha_num|confirmed',
                'password_confirmation' => 'required|string|min:8|max:20|alpha_num',
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
                'password_confirmation.required' =>'パスワード確認を入力してください',
                'password_confirmation.min' =>'パスワードは8文字以上、20文字以下で入力してください',
                'password_confirmation.max' =>'パスワードは8文字以上、20文字以下で入力してください',
                'password_confirmation.alpha_num' =>'パスワードは英数字のみで入力してください',
            ];

            $validator =Validator::make($data,$rules,$message);
            if($validator->fails()){
                return redirect('/register')
                ->withErrors($validator)
                ->withInput();
            }

            $this->create($data);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
    //        $this ->create($data); //thisで別メソッドの処理が使える
    //        $users = $request -> session() -> get('username', function(){
    //             return '$username';
    //          }); //クロージャー利用　処理の塊　

    //    dd($username); //値を確認できるもの

        return view('auth.added');

    }
}

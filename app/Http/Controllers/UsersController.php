<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    //
    public function search(Request $request)
    {
         $users = User::get();
         $searchWord =$request->input('searchWord');
         return view('users.search',['searchWord',['searchWord'=>$searchWord, 'users'=>$users]]);
    }
}

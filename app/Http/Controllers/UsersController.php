<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    
    //增加
      public function create()
    {
        return view('users.create');
    }

     //展示
     public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

     //新增
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
       //等于 redirect()->route('users.show', [$user->id]);moren 
        return redirect()->route('users.show', [$user]);


    }
}

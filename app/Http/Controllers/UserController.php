<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    // form for create user
    public function create () {
        return view ('user.create');
    }

    public function store (Request $data) {
        $this->validate($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'permission' => 'required',
            'rank' => 'required',
        ],[
            'email.unique' => 'Такой пользователь уже существует'
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->permission = $data['permission'];
        $user->rank = $data['rank'];
        $user->save();

        Auth::user()->logs()->create([
            'name' => 'addUser',
            'description' => 'Добавлен новый пользователь ['.$user->email.']'
            ]);

        return redirect()->back()->with(['msg'=>'Пользователь '.$user->email.' успешно добавлен']);
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        if (Auth::user()->permission<=$user->permission) {
            if (Auth::user()->id<>$user->id)
                return redirect()->back()->with(['msg'=>'Доступ закрыт']);
        }

        return view ('user.edit',[
            'user'=> $user
        ]);
    }

    public function save (Request $data, $user_id) {
        $this->validate($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'permission' => 'required',
            'rank' => 'required',
        ]);

        $user = User::findOrFail($user_id);
        if (Auth::user()->permission<=$user->permission) {
            if (Auth::user()->id<>$user->id)
                return redirect()->back()->with(['msg'=>'Доступ закрыт']);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($data['password']!='') $user->password = bcrypt($data['password']);
        $user->permission = $data['permission'];
        $user->rank = $data['rank'];
        $user->save();

        Auth::user()->logs()->create([
            'name' => 'editUser',
            'description' => 'Отредактирован пользователь ['.$user->email.']'
            ]);

        return redirect('/user/show')->with(['msg'=>'Пользователь '.$user->email.' успешно обновлен']);
    }

    public function savePassword(Request $data, $user_id)
    {
        $this->validate($data, [
           'password' => 'required|min:6'
        ]);

        $user = User::findOrFail($user_id);
        if (Auth::user()->permission<=$user->permission) {
            if (Auth::user()->id<>$user->id)
                return redirect()->back()->with(['msg'=>'Доступ закрыт']);
        }

        $user->password = bcrypt($data['password']);
        $user->save();

        Auth::user()->logs()->create([
            'name' => 'editPasswordUser',
            'description' => 'Изменен пароль пользователя ['.$user->email.']'
            ]);

        return redirect()->back()->with(['msg'=>'Пароль пользователя '.$user->email.' успешно обновлен']);
    }

    public function show()
    {
        return view('user.show', [
            'users' => User::where('rank','>',0)->orderBy('rank','desc')->paginate(15)
        ]);
    }

    public function search(Request $data)
    {
         $this->validate($data, [
            'name' => 'required|max:255',
        ],[
            
        ]);

        $user = User::where('email',$data['name'])->first();

        if ($user!=null) {
            return redirect('/user/edit/'.$user->id);
        } else {
            return redirect()->back()->with(['msg'=>'Пользователь не найден']);
        }
    }

    public function showDisable()
    {
        return view('user.showDisable', [
            'users' => User::where('rank','==',0)->orderBy('rank','desc')->get()
        ]);
    }

    public function disable($user_id)
    {
        $user = User::findOrFail($user_id);
        if (Auth::user()->permission<=$user->permission) {
            return redirect()->back()->with(['msg'=>'Доступ закрыт']);
        }

        $user->rank=0;
        $user->permission=0;
        $user->save();

        Auth::user()->logs()->create([
            'name' => 'disableUser',
            'description' => 'Выключен пользователь ['.$user->email.']'
            ]);

        return redirect()->back()->with(['msg'=>'Пользователь успешно выключен']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditingUser extends Controller
{
    //Переход на страницу личного аккаунта
    public function account()
    {
        return view('account');
    }

    //Переход на страницу редактирования аккаунта
    public function getEdit()
    {
        return view('auth.edit');
    }

    //Изменение данных пользователя
    public function postEdit(Request $request)
    {
        //Валидация полей
        //Проверка email на уникальность в случае если он был изменен
        if (Auth::user()->email != $request->input('email')) {
            $this->validate($request, ['email' => ['required', 'string', 'email', 'max:255', 'unique:users']]);
        }
        //Валидация остальных полей по примеру регистрации
        $this->validate($request, [
            'login_user' => ['required', 'string', 'max:255'],
            'fio' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        //Обновление основных данных
        Auth::user()->update([
            'login_user' => $request->input('login_user'),
            'fio' => $request->input('fio'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        //Переадресация на страницу личного кабинета
        return redirect('account')->with([
            'info' => 'Ваши изменения были успешно внесены!',
            'info_message' => true
        ]);
    }
}

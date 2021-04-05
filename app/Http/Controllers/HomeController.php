<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //Переход на страницу личного аккаунта
    public function account(){
        return view('account');
    }
    //Переход на страницу редактирования аккаунта
    public function getEdit(){
        return view('auth.edit');
    }
    //
    public function postEdit(Request $request){

        Auth::user()->update([
            'login_user' => $request->input('login_user'),
            'fio' => $request->input('fio'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()
            -> route('auth.edit');
    }
}

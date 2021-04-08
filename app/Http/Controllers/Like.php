<?php

namespace App\Http\Controllers;

use App\Likes;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Like extends Controller
{
    public  function likeNews(Request $request)
    {
        //Добавляем запись
            Likes::create(array(
                'user_id' => Auth::user()->id,
                'news_id' => $request->input('news_id')
            ));
            return redirect('info');


    }
}

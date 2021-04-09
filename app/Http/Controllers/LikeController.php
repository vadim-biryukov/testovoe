<?php

namespace App\Http\Controllers;

use App\Likes;
use App\News;
use App\News_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class LikeController extends Controller
{

    public function newsLike(Request $request)
    {
        $id_user = Auth::user()->id;
        $id = $request->input('news_id');
//      Не очень хорошая практика смотреть прямо в базу из php
//        $contact = DB::table('likes')->where([
//            ['news_id', '=', $id],
//            ['user_id', '=', $id_user],
//        ]);
//      Лучше сделать поиск модели
        $contact = Likes::all()
            ->where('news_id', $id)
            ->where('user_id', $id_user);

// Так же непонятно нажал я лайк или нет, можно добаить проверку и уведомление
// в самом шаблоке newsDetail нужна будет проверка на приём сообщения, я ее добавил

        if ($contact->count() == 0) {
            Likes::create(array(
                'user_id' => $id_user,
                'news_id' => $id
            ));
            //Редиректим с уведомлением
          return redirect('newsDetail?id='.$id)
              ->withErrors(['лайк поставлен!']);
        }
        //если условие не выполняется вернем сообщение что лайк уже поставлен
         else{ return redirect('newsDetail?id='.$id)
            ->withErrors(['вы уже ставили лайк!']); }
    }
}

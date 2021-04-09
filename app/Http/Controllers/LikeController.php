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
        $contact = DB::table('likes')->where([
            ['news_id', '=', $id],
            ['user_id', '=', $id_user],
        ]);
        if ($contact->count() == 0) {
            Likes::create(array(
                'user_id' => $id_user,
                'news_id' => $id
            ));

        }
        $read = News::find($id);
        $news_id = $id;
        $count_like = Likes::where('news_id', $id)->count();
        $news_types_id = News::find($id)->news_types_id;
        $type_title = News_type::find($news_types_id)->title;
        return redirect('newsDetail?id='.$id);

    }
}

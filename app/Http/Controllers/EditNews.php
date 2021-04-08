<?php

namespace App\Http\Controllers;

use App\Likes;
use App\News;
use App\News_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EditNews extends Controller
{
    public function editPost()
    {
        $news_title = News::all()->sortByDesc('sorting');
        $type_title = News_type::all();
        return view('admin.edit_news')->with([
            'news_title' => $news_title,
            'type_title' => $type_title
        ]);

    }
    public function editNews(Request $request)
    {
        if (!$request->file('img')) {
            $filename = $request->input('imgold');
        } else {
            // загрузка файла
            if ($request->isMethod('post') && $request->file('img')) {

                $file =$request->file('img');
                $upload_folder = 'public/folder';
                $filename = $file->getClientOriginalName();
                Storage::putFileAs($upload_folder, $file, $filename);

            }
        }
        $id = $request->input('id');
        //Обновление основных данных
        $contact = News::find($id);

        $this->validate($request, [
            'header' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],

            'sorting' => ['required', 'integer', 'max:100']
        ]);
        $id = $request->input('id');
        //Обновление основных данных
        $contact = News::find($id);
        if ($request->input('day_news') != '' && $contact->day_news !='1') {
            $this->validate($request, ['day_news' => ['required', 'integer', 'max:1', 'unique:news']]);
        }

        $contact->header = $request->input('header');
        $contact->text = $request->input('text');
        $contact->img = $filename;
        $contact->sorting = $request->input('sorting');
        $contact->day_news = $request->input('day_news') ?? '0';
        $contact->news_types_id = $request->input('news_types_id');

        $contact->save();

        //Переадресация на страницу личного кабинета
        return redirect('admin/edit_news')->with([
            'info' => 'Ваши изменения были успешно внесены!',
            'info_message' => true
        ]);
    }

}

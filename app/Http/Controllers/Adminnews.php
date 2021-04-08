<?php

namespace App\Http\Controllers;

use App\News;
use App\News_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class Adminnews extends Controller
{
    public function getPanel()
    {
        $type_title=News_type::all();
        return view('admin.admin_news',compact('type_title'));

    }


    protected function postNews(Request $request)
    {
        $this->validate($request, [
            'header' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'img' => ['required', 'image'],
            'sorting' => ['required','integer', 'max:100']
        ]);
        if ($request->input('day_news')!='') {
            $this->validate($request, ['day_news' => ['required', 'integer', 'max:1', 'unique:news']]);
        }

        // загрузка файла
        if ($request->isMethod('post') && $request->file('img')) {

            $file = $request->file('img');
            $upload_folder = 'public/folder';
            $filename = $file->getClientOriginalName();
            Storage::putFileAs($upload_folder, $file, $filename);

        }
        //Добавляем запись
        News::create(array(
            'header' => $request->input('header'),
            'text' => $request->input('text'),
            'img' => $file->getClientOriginalName(),
            'sorting' => $request->input('sorting'),
            'day_news' => $request->input('day_news') ?? '0',
            'news_types_id' => $request->input('news_types_id')
        ));
        return redirect('/admin/admin_news')->with([
            'info' => 'Новость добавлена!',
            'info_message' => true
        ]);
    }


}

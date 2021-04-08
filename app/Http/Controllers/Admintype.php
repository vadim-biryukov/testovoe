<?php

namespace App\Http\Controllers;

use App\News;
use App\News_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class Admintype extends Controller
{
    public function getPanel()
    {
        return view('admin.admin_panel');
    }

    protected function postType(Request $request)
    {
        $this->validate($request, ['title' => ['required', 'string', 'max:255']]);

        News_type::create(array(
            'title'  => $request->input('title')
        ));
        return redirect('/admin/admin_panel')->with([
            'info' => 'Новый тип новостей добавлен!',
            'info_message' => true
        ]);
    }


}

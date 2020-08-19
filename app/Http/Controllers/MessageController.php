<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message; //Model Message
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'title'=>'Гостевая книга',
            'metaTitlePrefix'=> ' Обзор сообщений',
            'countOfMessages'=> Message::count(),
            'allMessages'=> Message::Latest()->paginate(5),
        );

        return view('index', $data);
    }
    public function index2()
    {
        $data = array(
            'title'=>'Гостевая книга.</br> Чтобы оставить и редактировать записи авторизуйтесь',
            'metaTitlePrefix'=> ' Обзор сообщений',
            'countOfMessages'=> Message::count(),
            'allMessages'=> Message::Latest()->paginate(5),
        );

        return view('index2', $data);
    }
    public function admin()
    {
        $data = array(
            'title'=>'Гостевая книга.</br> Админка',
            'metaTitlePrefix'=> ' Обзор сообщений',
            'countOfMessages'=> Message::count(),
            'allMessages'=> Message::Latest()->paginate(5),
        );

        return view('admin', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validationResult = $this->_validation($input);

        if (!is_null($validationResult)) {
            return $validationResult;
        } // if
        $message = new Message();
        $message->name = $input['name'];
        $message->phone = $input['phone'];
        $message->message = $input['message'];
        $message->user_id = Auth::id();
        $message->username = Auth::user()->name;

        if ($message->save()) {
            return redirect()
                ->route('messages.index')
                ->with('sessionMessage', 'Запись добавлена.');
        } // if

        abort(500);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $previus = Message::where('id', '<', $message->id)->select('id')->orderby('id', 'desc')->first();
        $previusID = ($previus != NULL) ? $previus->id : NULL;

        $next = Message::where('id', '>', $message->id)->select('id')->orderby('id', 'asc')->first();
        $nextID = ($next != NULL) ? $next->id : NULL;

        $data = array(
            'title' => 'Гостевая книга.<br> Просмотр записи.',
            'metaTitlePrefix'=> 'Просмотр одной записи.',
            'message' => $message,
            'previusID' => $previusID,
            'nextID' => $nextID
        );
        return view('show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message) {
        $data = array(
            'title' => 'Исправление сообщения.',
            'metaTitlePrefix' => 'Исправление сообщения. ',
            'message' => $message,
        );
        return view('edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message) {
        $input = $request->all();
        $validationResult = $this->_validation($input, $message->id);

        if (!is_null($validationResult)) {
            return $validationResult;
        }

        $message->name = $input['name'];
        $message->message = $input['message'];

        if ($message->save()) {
            return redirect()
                ->route('messages', array('#'.$message->id))
                ->with('sessionMessage', 'Запись изменена.');
        }
        abort(500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Message $message) {
        $message->delete();
        return redirect()
            ->route('messages')
            ->with('sessionMessage', 'Запись удалена.');
    }
    private function _validation($input, $id = NULL) {
        $validatorErrorMessages = array(
            'required' => 'Поле :attribute обязательно к заполнению',
        );

        $validator = Validator::make(
            $input,
            array(
                'name' => 'required|max:255',
                'message' => 'required',
            ),
            $validatorErrorMessages);

        if ($validator->fails()) {
            $redirectURL = ($id == NULL) ?
                route('messages.index') :
                route('messages.edit', $id);

            return redirect($redirectURL)
                ->withErrors($validator)
                ->withInput();
        } // if

        return NULL;
    }
}

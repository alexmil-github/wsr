<?php

namespace App\Http\Controllers;

use App\Message;
use App\Theme;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return Message::all();
    }

    public function store(Request $request, $id)
    {
        $theme = Theme::find($id);
        return Message::create([
                'theme-id' => $theme->id,
                'user_id' => Auth::user()->id
            ] + $request->all());
    }

    public function show(Message $message)
    {
        return $message;
    }

    public function update(Request $request, Message $message)
    {
        return $message->update($request->all());
    }

    public function destroy(Message $message)
    {
        return $message->delete();
    }


}

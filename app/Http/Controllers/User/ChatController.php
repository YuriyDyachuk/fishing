<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $chats = request()->user()
                          ->chats()
                          ->select('id', 'message','created_at', 'sender_id')
                          ->with('sender', function($query) {
                            return $query->select('id', 'name');
                          })
                          ->get();

        return view('sites.profiles.chats.index', ['chats' => $chats]);
    }

    public function store()
    {
        //
    }

    public function show(int $id)
    {
        //
    }

    public function destroy($id,$chatId)
    {
        dd($id,$chatId);
    }
}

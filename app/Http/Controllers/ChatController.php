<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {

        return view('home');
    }

    public function getChat($chatId) {

        $chatExists = Chat::where('id', $chatId)->exists();

        return view('chat', compact('chatExists'));
    }

    public function fetchChats() {

        $chats = Chat::pluck('name');

        return response()->json(['chats' => $chats]);
    }

    public function createChat(Request $request) {

        $userId = Auth::id();

        $chat = Chat::create([
            
            'user_id' => $userId,

            'name' => $request->input('name'),
        ]);

        return response()->json([
            
            'status' => 'Chat created successfully!',

            'chatId' => $chat->id,
        ]);
    }

    public function fetchMessages() {

        return Message::with('user:id,name')->get();
    }

    public function sendMessage(Request $request) {

        $id = Auth::id();

        $message = Message::create([

            'content' => $request->input('message'),

            'user_id' => $id,

            'chat_id' => $request->input('chatId'),
        ]);

        event(new MessageEvent($message));

        return ['status' => 'Message sent!'];
    }
}
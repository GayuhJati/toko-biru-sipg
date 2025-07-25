<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $roomId = $request->query('room_id');
        return Message::where('room_id', $roomId)
            ->orderBy('created_at')
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|string|max:255',
            'name' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        $message = new Message();
        $message->name = $request->input('name');
        $message->message = $request->input('message');
        $message->room_id = $request->input('room_id');

        if (Auth::check()) {
            $message->user_id = Auth::id();
        } else {
            $message->user_id = null;
        }

        $message->save();

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message->load('user'), 201);
    }
}

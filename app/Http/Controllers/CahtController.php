<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CahtController extends Controller
{
      // 1. List all conversations for logged-in user
    public function index()
    {
        return view('web.chat.index');
    }

    public function startConversation($reciveId)
    {
        $userId=Auth::id();

        
    }

    public function show($conversationId)
    {
           

            return view('web.chat.show',compact('conversationId'));
    }

    
   
}

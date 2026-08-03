<?php

namespace App\Livewire\Web\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class Conversations extends Component
{
    
    public $conversation;
    public $newMessage;
    public $messages;

    public function mount($conversationId)
    {
        $this->conversation=Conversation::query()->with('messages.sender')->findOrFail($conversationId);
        $this->loadMessages();
        

    }

    public function loadMessages()
    {
        $this->messages=$this->conversation->messages()
        ->with('sender')->latest()
        ->take(20)
        ->get()->reverse();

        $this->markAsRead();
        
    }

    public function sendMessage()
    {
        if(!$this->newMessage) return;

        $message=Message::query()->create([

           'conversation_id'=>$this->conversation->id,
           'sender_id'=>Auth::id(),
           'message'=>$this->newMessage,
          
        ]);

        $this->newMessage='';
        $this->loadMessages();
    }

    public function markAsRead()
    {
        Message::query()->where('conversation_id',$this->conversation->id)
        ->where('sender_id','!=',Auth::id())->where('is_read',false)->update([
            'is_read' => true,
                'read_at' => now(),
        ]);
    }
    public function render()
    {
        return view('livewire.web.chat.conversations');
    }
}

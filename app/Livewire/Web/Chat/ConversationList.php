<?php

namespace App\Livewire\Web\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ConversationList extends Component
{

    public $conversations=[];
    public $showNewConversationForm=false;
    public $users;
    public $selectedUser = null;

    public function mount()
    {
        $this->loadListMessages();
    }
    public function loadListMessages()
    {
        $this->conversations = Conversation::query()
            ->where('user_one_id', Auth::id())
            ->orWhere('user_two_id', Auth::id())
            ->with([
                'userOne',
                'userTwo',
                'messages' => function ($q) {
                    $q->latest()->limit(1); // فقط آخرین پیام
                }
            ])
            ->latest('updated_at')
            ->get();
    }
    public function newConversation()
    {
        $this->users=User::query()->
        where('id','!=',Auth::id())
        ->pluck('name','id')
        ->toArray();

        $this->showNewConversationForm=true;

    }

    public function startConversation()
    {
        if(! $this->selectedUser) return;

         $userId = Auth::id();
         $reciveId = $this->selectedUser;

         $conversation=Conversation::query()->where(function($q) use($userId,$reciveId){
            $q->where('user_one_id',$userId)->where('user_two_id',$reciveId);
        })->orWhere(function($q1) use($userId,$reciveId){
            $q1->where('user_one_id',$reciveId)->where('user_two_id',$userId);
        })->first();

        if(!$conversation)
        {
            Conversation::query()->create([
                'user_one_id'=>$userId,
                'user_two_id'=>$reciveId
            ]);
        }

        return redirect()->route('chat.show',$conversation->id);
    }
    public function render()
    {
        
        return view('livewire.web.chat.conversation-list');
    }
}

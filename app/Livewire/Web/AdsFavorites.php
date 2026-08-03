<?php

namespace App\Livewire\Web;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdsFavorites extends Component
{
    public $favorites=[];
   
      

    public function deleteAd($id)
    {
         $userId=Auth::id();
        $user=User::query()->find($userId);
        $ad=Ad::query()->find($id);
        $user->favorites()->detach($ad->id);//حذف از جدول علاقه مندی ها
    }
    public function render()
    {
        $userId=Auth::id();
        $user=User::query()->find($userId);
        $this->favorites=$user->favorites()->latest()->get();
        return view('livewire.web.ads-favorites');
    }
}

<?php

namespace App\Livewire\Web;

use App\Models\Ad;
use Livewire\Component;
use Livewire\WithPagination;
class Ads extends Component
{
    public $user_id;
    use WithPagination;
    public function render()
    {
        $ads=Ad::query()->where('user_id',$this->user_id)->paginate(10);
        return view('livewire.web.ads',compact('ads'));
    }
    public function deleteAd($id)
    {
        $ad=Ad::query()->findOrFail($id);
        if($ad->user_id==$this->user_id)
        {
            $ad->delete();
        }
    }
}

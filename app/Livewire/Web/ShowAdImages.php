<?php

namespace App\Livewire\Web;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowAdImages extends Component
{
    public $ad_id;
    

    public function removePhoto($id)
    {
        $photo=Image::query()->findOrFail($id);
        $photo->delete();
    }
    public function render()
    {
        $photos=Image::query()->where('user_id',Auth::id())->where('ad_id',$this->ad_id)->get();
        return view('livewire.web.show-ad-images',compact('photos'));
    }
}

<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdImagesUpload extends Component
{

    use WithFileUploads;
    public $photos=[];
    public $ad_id;

    public function removePhoto($index)
    {
        // از آرایه حذف می‌کنیم
        unset($this->photos[$index]);

        //دوباره ایندکس‌ها رو مرتب می‌کنیم

        $this->photos=array_values($this->photos);
    }
    public function save()
    {
        $this->validate([
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,webp|max:2048',
        ]);

        foreach ($this->photos as $photo) {
            // ذخیره فایل در storage/app/public/ads
            $path = $photo->store('ads', 'public');

            // ذخیره در دیتابیس
            Image::create([
                'user_id' => Auth::id(),
                'ad_id'   => $this->ad_id,
                'image'   => $path,
            ]);
        }

        // خالی کردن آرایه بعد از ذخیره
        $this->photos = [];

        session()->flash('success', 'عکس‌ها با موفقیت ذخیره شدند ✅');
    }

    public function render()
    {
        return view('livewire.ad-images-upload');
    }
}

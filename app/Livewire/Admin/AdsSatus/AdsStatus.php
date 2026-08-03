<?php

namespace App\Livewire\Admin\AdsSatus;

use App\Models\Ad;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdsStatus extends Component
{
    public $search='';
    
    use WithPagination;
    public function getQuery()
    {
        return Ad::query()->with('category')
        ->when($this->search,function($q){
            $q->where('title','like','%'.$this->search.'%')
            ->orWhereHas('category',function ($q1) {
                $q1->where('title','like','%'.$this->search.'%');
            });
        }
        )->latest()->paginate(10);
    }

    public function changeStatus($id)
    {

        $ad=Ad::query()->findOrFail($id);

        if($ad->status==\App\Enums\AdStatus::Pending->value)
            {
                $ad->update([
                    'status'=>\App\Enums\AdStatus::Approved->value,
                    'expired_at'=>now()->addDays(30)

                ]);
            }
            elseif($ad->status==\App\Enums\AdStatus::Approved->value)
                {
                    $ad->update([
                    'status'=>\App\Enums\AdStatus::Rejected->value
                ]);
                }

                else{
                    $ad->update([
                    'status'=>\App\Enums\AdStatus::Pending->value
                    ]);
                }
                $this->resetPage();
    }

    public function deleteAd($id)
    {
        $ad=Ad::query()->findOrFail($id);
        if($ad)
            {
                $ad->delete();
                $this->resetPage();
            }
    }
    public function render()
    {
        $ads=$this->getQuery();
        return view('livewire.admin.ads-satus.ads-status',compact('ads'));
    }
}

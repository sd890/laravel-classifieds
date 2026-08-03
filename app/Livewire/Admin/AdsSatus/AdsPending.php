<?php

namespace App\Livewire\Admin\AdsSatus;

use Livewire\Component;
use App\Models\Ad;
use Livewire\WithPagination;

class AdsPending extends Component
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
        )->where('status',\App\Enums\AdStatus::Pending->value)->latest()->paginate(10);
    }

    public function changeStatus($id)
    {

        $ad=Ad::query()->findOrFail($id);

        if($ad->status==\App\Enums\AdStatus::Pending->value)
            {
                $ad->update([
                    'status'=>\App\Enums\AdStatus::Approved->value
                ]);
            }
            
                $this->resetPage();
    }
    public function render()
    {
        $ads=$this->getQuery();
        return view('livewire.admin.ads-satus.ads-pending',compact('ads'));
    }
}

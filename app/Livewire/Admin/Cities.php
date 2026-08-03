<?php

namespace App\Livewire\Admin;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;
class Cities extends Component
{
    public $search='';
    use WithPagination;
    public function render()
    {
        $cities=City::query()->with('province')->when($this->search,function($query){
            $query->where('city','like','%'.$this->search.'%')->orWhereHas('province',function($q){

                $q->where('title','like','%'.$this->search.'%');
            });

        })->latest()->paginate(10);
        
         
            
        

        return view('livewire.admin.cities',compact('cities'));
    }
    
    public function deleteCity($id)
    {
        $city=City::query()->find($id);
        $city->delete();
    }
}

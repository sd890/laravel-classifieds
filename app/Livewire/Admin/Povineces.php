<?php

namespace App\Livewire\Admin;

use App\Models\Province;
use Livewire\Component;
use Livewire\WithPagination;

class Povineces extends Component
{
    public $search;
    use WithPagination;
    public function render()
    {
        $provineces=Province::query()->when($this->search,function($query){
            $query->where('title','like','%'.$this->search.'%');
        })->paginate(10);

        return view('livewire.admin.povineces',compact('provineces'));
    }

    public function deleteProvinece($id)
    {
        $provinece=Province::query()->find($id);
        $provinece->delete();
    }
}

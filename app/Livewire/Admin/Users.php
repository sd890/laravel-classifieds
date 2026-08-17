<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    public $search="";
    use WithPagination;

    public function getQuery()
    {
        return User::query()->
        when($this->search,function ($query) {
            
        $query->where('name','like','%'.$this->search.'%')->
        orWhere('username','like','%'.$this->search.'%')
        ->orWhere('email','like','%'.$this->search.'%')
        ->orWhere('mobile','like','%'.$this->search.'%');

        })->latest()->paginate(10);
    } 
    public function render()
    {
        $users=$this->getQuery();
        return view('livewire.admin.users',compact('users'));
    }
}

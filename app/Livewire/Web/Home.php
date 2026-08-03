<?php

namespace App\Livewire\Web;

use Livewire\Component;
use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use Livewire\WithPagination;

class Home extends Component
{
    public $search='';
    public $selectedCity='';
    public $selectedCategory='';
    use WithPagination;

    // تنظیم نام پارامتر برای Pagination وقتی جستجو تغییر می‌کند
    protected $updatesQueryString = ['search'];
    protected $paginationTheme = 'bootstrap'; // یا tailwind بسته به پروژه

    public function updatingSearch()
    {
        $this->resetPage(); // وقتی جستجو تغییر کرد به صفحه اول برو
    }
    public function render()
    {
         $ads = Ad::query()
            ->with('city', 'category')
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhereHas('city', function ($q1) {
                            $q1->where('city', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('category', function ($q2) {
                            $q2->where('title', 'like', '%' . $this->search . '%');
                        });
                });
            })->when($this->selectedCategory,function($q)
            {
                $q->where('category_id',$this->selectedCategory);
            })->when($this->selectedCity,function($q)
            {
                $q->where('city_id',$this->selectedCity);
            })
            ->where('status',\App\Enums\AdStatus::Approved)->latest()
            ->paginate(20);

            $categories = Category::orderBy('title')->pluck('title', 'id');
            $cities= City::orderBy('city')->pluck('city', 'id');


        return view('livewire.web.home',compact('ads','categories','cities'));
    }
}

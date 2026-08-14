<?php

namespace App\Livewire\Web;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;


class PublicAds extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public $selectedCategory="";
    public $search="";
    public $selectedCity="";

    public $minPrice="";
    public $maxPrice="";

    public $hasImage=false;

    public $publishDate="";

    public $sort="latest";
     public $categories="";
     public $cities="";
    
    public function mount()
    {
    $this->categories=Category::query()->pluck('title','id');
    $this->cities=City::query()->pluck('city','id');

    }
   
    public function getAdsQuery()
    {
        return Ad::query()->where('status',\App\Enums\AdStatus::Approved)
        ->where(function ($query) {
            $query->whereNull('expired_at')
            ->orWhere('expired_at','>',now());
        })
        ->with('city','category')
        ->when($this->search,function ($q) {
            $q->where(function($query){
                $query->where('title','like','%'.$this->search.'%')
                ->orWhere('slug','like','%'.$this->search.'%')
                ->orWhereHas('city',function($q1){
                    $q1->where('city','like','%'.$this->search.'%');
                })
                ->orWhereHas('category',function ($q2) {
                     $q2->where('title','like','%'.$this->search.'%');

                });
            });
        })->when($this->selectedCategory,function($query){
            
            $query->where('category_id',$this->selectedCategory);

        })->when($this->selectedCity,function($query){

            $query->where('city_id',$this->selectedCity);

        })->when($this->minPrice,function($q){

            $q->where('price','>=',$this->minPrice);

        })->when($this->maxPrice,function($q){

             $q->where('price','<=',$this->maxPrice);

        })->when($this->hasImage, function ($q) {

            $q->whereNotNull('image')
             ->where('image', '<>', '')->
             orHas('images');
            
        })->when($this->publishDate, function ($q) {

            match ($this->publishDate) {

            'today' => $q->whereDate('created_at', today()),

            'week' => $q->where('created_at', '>=', now()->subWeek()),

            'month' => $q->where('created_at', '>=', now()->subMonth()),

            default => null,

          };
        })->when($this->sort=='latest',function($q){

        $q->latest();

        })->when($this->sort=='oldest',function($q){

        $q->oldest();

        })->when($this->sort == 'cheap', function ($q) {
            $q->orderBy('price');
        })
        ->when($this->sort == 'expensive', function ($q) {
            $q->orderByDesc('price');
        });
    }
    public function render()
    {
        
       $ads=$this->getAdsQuery()->latest()
            ->paginate(20);

    


        return view('livewire.web.public-ads',[

    'ads' => $ads,
    'categories' => $this->categories,
    'cities' => $this->cities,]);
    }

     public function searchAds()
    {
      $this->resetPage();
       
        
    }

    public function filterSearch()
    {
        $this->resetPage();
    }
}

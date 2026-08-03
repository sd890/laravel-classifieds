<div class="container-fluid mt-4">
    <div class="row">

        {{-- سایدبار فیلتر --}}
        <div class="col-lg-3 order-lg-2 mb-3">

            {{-- جستجو --}}
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    جستجو
                </div>

                <div class="card-body">

                    <input type="text"
                           class="form-control mb-3"
                           placeholder="عنوان آگهی..."
                           wire:model.defer="search">

                    <select class="form-select mb-3"
                            wire:model.defer="selectedCategory">

                        <option value="">همه دسته بندی ها</option>

                        @foreach($categories as $id=>$title)
                            <option value="{{$id}}">
                                {{$title}}
                            </option>
                        @endforeach

                    </select>

                    <select class="form-select mb-3"
                            wire:model.defer="selectedCity">

                        <option value="">همه شهرها</option>

                        @foreach($cities as $id=>$city)
                            <option value="{{$id}}">
                                {{$city}}
                            </option>
                        @endforeach

                    </select>

                    <button class="btn btn-primary w-100"
                            wire:click="searchAds">

                        جستجو

                    </button>

                </div>
            </div>

            {{-- فیلترها --}}
            <div class="card shadow-sm">

                <div class="card-header bg-secondary text-white">
                    فیلترها
                </div>

                <div class="card-body">

                    <label>بازه قیمت</label>

                    <input type="number"
                           class="form-control mb-2"
                           placeholder="از" wire:model.defer="minPrice">

                    <input type="number"
                           class="form-control mb-3"
                           placeholder="تا" wire:model.defer="maxPrice">

                    <div class="form-check mb-3">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model.defer="hasImage" id="hasImage">

                        <label class="form-check-label"  for="hasImage">
                            فقط آگهی دارای عکس
                        </label>
                    </div>

                    <label>تاریخ انتشار</label>

                         <select class="form-select"
                                wire:model.defer="publishDate">

                            <option value="">همه</option>

                            <option value="today">
                                امروز
                            </option>

                            <option value="week">
                                هفته اخیر
                            </option>

                            <option value="month">
                                ماه اخیر
                            </option>

                        </select>

                       
                      <label>مرتب سازی براساس </label>

                    <select class="form-select mb-3"
                            wire:model.defer="sort">

                       

                            <option value="latest">
                                جدیدترین
                            </option>

                            <option value="oldest">
                                قدیمی ترین
                            </option>

                            <option value="cheap">
                                ارزان ترین
                            </option>

                         <option value="expensive">
                                گران ترین
                            </option>


                    </select>
                       

                    <button class="btn btn-success w-100 mt-3" wire:click="filterSearch">

                        اعمال فیلتر

                    </button>

                </div>

            </div>

        </div>
  <div class="col-lg-9 order-lg-1">
  
    <div class="row">
        @foreach($ads as $ad)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow h-100 rounded-4">
                    {{-- تصویر آگهی (در صورت وجود) --}}
                    @if($ad->image)
                        <img src="{{ asset('images/Ads/smallImages/'.$ad->image) }}" 
                             class="card-img-top" 
                             alt="{{ $ad->title }}" 
                              style="height:220px;object-fit:cover;">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" 
                             class="card-img-top" 
                             alt="بدون تصویر" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $ad->title }}</h5>
                        <p class="text-muted mb-1">{{ $ad->short_desc }}</p>
                        <p class="small">{{ Str::limit($ad->description, 100) }}</p>

                        {{-- قیمت --}}
                        <p class="mb-1">
                            <strong class="text-success">قیمت:</strong>
                            @if($ad->price)
                                {{ number_format($ad->price) }} تومان
                            @else
                                {{ $ad->price_type == 'fixed' ? 'قیمت مقطوع' : 'قیمت توافقی' }}
                            @endif
                        </p>

                       

                        {{-- دکمه‌ها --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('show.public.ads', $ad->id) }}" 
                               class="btn btn-outline-primary btn-sm">نمایش کامل آگهی</a>
                               
                        </div>
                    </div>
                <div class="mt-3 text-muted small">
                <i class="bi bi-clock"></i> زمان انتشار : 

                {{ $ad->created_at->diffForHumans() }}
            </div> 
                </div>
                
            </div>

             
        @endforeach
    </div>
    <div style="margin: 40px !important;"
						 class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
						 {{$ads->appends(Request::except('page'))->links()}}
					</div>
</div>
</div>
                    
</div>


<div class="table overflow-auto" tabindex="8">
    <div class="row mb-3">
      {{-- جستجو و فیلتر --}}
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="جستجوی عنوان"
                   wire:model.live="search">
        </div>
    <div class="col-md-4">
            <select class="form-select" wire:model.live="selectedCategory">
                <option value="">انتخاب دسته‌بندی</option>
                @foreach($categories as $id => $title)
                    <option value="{{ $id }}">{{ $title }}</option>
                @endforeach
            </select>
        </div>
         <div class="col-md-4">
            <select class="form-select" wire:model.live="selectedCity">
                <option value="">انتخاب شهر</option>
                @foreach($cities as $id => $city)
                    <option value="{{ $id }}">{{ $city }}</option>
                @endforeach
            </select>
        </div>
    </div>
<div class="container mt-4" style="direction: rtl;">
  
    <div class="row">
        @foreach($ads as $ad)
            <div class="col-md-6 col-lg-4 mb-4" style="width:50%;">
                <div class="card shadow-sm border-0 h-100">
                    {{-- تصویر آگهی (در صورت وجود) --}}
                    @if($ad->image)
                        <img src="{{ asset('images/Ads/smallImages/'.$ad->image) }}" 
                             class="card-img-top" 
                             alt="{{ $ad->title }}" 
                             style="height: 200px; object-fit: cover;">
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

                        {{-- وضعیت --}}
                        <p class="mb-3">
                            <strong>وضعیت:</strong>
                            @if($ad->status == \App\Enums\AdStatus::Pending->value)
                                <span class="badge bg-warning text-dark">در انتظار تایید</span>
                            @elseif($ad->status == \App\Enums\AdStatus::Approved->value)
                                <span class="badge bg-success">تایید شده</span>
                            @else
                                <span class="badge bg-danger">عدم تایید</span>
                            @endif
                        </p>

                        {{-- دکمه‌ها --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('show.public.ads', $ad->id) }}" 
                               class="btn btn-outline-primary btn-sm">نمایش کامل آگهی</a>
                               
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
                    <div style="margin: 40px !important;"
						 class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
						 {{$ads->appends(Request::except('page'))->links()}}
					</div>
</div>

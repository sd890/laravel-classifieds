<div class="container mt-4" style="direction: rtl;">
    <div class="row">
        @foreach($favorites as $fav)
            <div class="col-md-6 col-lg-4 mb-4" style="width:50%;">
                <div class="card shadow-sm border-0 h-100">
                    {{-- تصویر آگهی (در صورت وجود) --}}
                    @if($fav->image)
                        <img src="{{ asset('images/Ads/smallImages/'.$fav->image) }}" 
                             class="card-img-top" 
                             alt="{{ $fav->title }}" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" 
                             class="card-img-top" 
                             alt="بدون تصویر" 
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $fav->title }}</h5>
                        <p class="text-muted mb-1">{{ $fav->short_desc }}</p>
                        <p class="small">{{ Str::limit($fav->description, 100) }}</p>

                        {{-- قیمت --}}
                        <p class="mb-1">
                            <strong class="text-success">قیمت:</strong>
                            @if($fav->price)
                                {{ number_format($fav->price) }} تومان
                            @else
                                {{ $fav->price_type == 'fixed' ? 'قیمت مقطوع' : 'قیمت توافقی' }}
                            @endif
                        </p>

                        {{-- وضعیت --}}
                        <p class="mb-3">
                            <strong>وضعیت:</strong>
                            @if($fav->status == \App\Enums\AdStatus::Pending->value)
                                <span class="badge bg-warning text-dark">در انتظار تایید</span>
                            @elseif($fav->status == \App\Enums\AdStatus::Approved->value)
                                <span class="badge bg-success">تایید شده</span>
                            @else
                                <span class="badge bg-danger">عدم تایید</span>
                            @endif
                        </p>

                        {{-- دکمه‌ها --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('show.public.ads', $fav->id) }}" 
                               class="btn btn-outline-primary btn-sm">نمایش کامل آگهی</a>
                               
                            <button wire:click="deleteAd({{ $fav->id }})" 
                                    class="btn btn-outline-danger btn-sm">حذف علاقه‌مندی</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

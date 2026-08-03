{{-- resources/views/ads/show.blade.php --}}
@extends('web.profile.layout.site')

@section('content')
<div class="container" style="direction: rtl;">
    <div class="card shadow">
        @if($ad->image)
            <img src="{{ asset('images/Ads/smallImages/' . $ad->image) }}" 
                 class="card-img-top" 
                 alt="{{ $ad->title }}" 
                 style="height: 300px; object-fit: cover;">
        @endif

        <div class="card-body" style="min-height: 500px;">
            <h3 class="card-title text-primary">{{ $ad->title }}</h3>

            {{-- تب‌ها --}}
            <ul class="nav nav-tabs" id="adTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="details-tab" data-bs-toggle="tab" 
                            data-bs-target="#details" type="button" role="tab">
                        جزئیات آگهی
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="desc-tab" data-bs-toggle="tab" 
                            data-bs-target="#desc" type="button" role="tab">
                        توضیحات کامل
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="views-tab" data-bs-toggle="tab" 
                            data-bs-target="#views" type="button" role="tab">
                        تعداد بازدید
                    </button>
                </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="photos-tab" data-bs-toggle="tab" 
                            data-bs-target="#photos" type="button" role="tab" >
                         تصاویر محصول
                    </button>
                </li>
            </ul>

            {{-- محتوای تب‌ها --}}
            <div class="tab-content mt-3" id="adTabsContent">
                {{-- جزئیات آگهی --}}
                <div class="tab-pane fade show active" id="details" role="tabpanel">
                    <p><strong>شرح مختصر:</strong> {{ $ad->short_desc }}</p>

                    <p>
                        <strong>قیمت:</strong>
                        @if($ad->price === null)
                            @if($ad->price_type == 'fixed')
                                قیمت مقطوع
                            @else
                                قیمت توافقی
                            @endif
                        @else
                            {{ number_format($ad->price) }} تومان
                        @endif
                    </p>

                    <p>
                        <strong>وضعیت:</strong>
                        @if($ad->status == \App\Enums\AdStatus::Pending->value)
                            <span class="badge bg-warning text-dark">در انتظار تایید</span>
                        @elseif($ad->status == \App\Enums\AdStatus::Approved->value)
                            <span class="badge bg-success">تایید شده</span>
                        @else
                            <span class="badge bg-danger">رد شده</span>
                        @endif
                    </p>
                </div>

                {{-- توضیحات کامل --}}
                <div class="tab-pane fade" id="desc" role="tabpanel">
                    {{ $ad->description }}
                </div>

                {{-- تعداد بازدید --}}
                <div class="tab-pane fade" id="views" role="tabpanel">
                    <h5>این آگهی تا الان <span class="text-primary">{{ $ad->views }}</span> بار دیده شده است.</h5>
                </div>

                 {{--  تصاویر محصول --}}
                <div class="tab-pane fade" id="photos" role="tabpanel">
                 <livewire:web.show-ad-images :ad_id="$ad->id"/>  
                </div>
            </div>

            {{-- دکمه‌ها --}}
            <div class="mt-3">
                <a href="{{ route('my_ads.edit', $ad->id) }}" class="btn btn-outline-primary">
                    ویرایش
                </a>

                 <a href="{{ route('add.images.ad', $ad->id) }}" class="btn btn-outline-primary">
                    افزودن عکس
                </a>
                <form action="{{ route('my_ads.destroy', $ad->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" 
                            onclick="return confirm('آیا مطمئن هستید که می‌خواهید این آگهی را حذف کنید؟')">
                        حذف
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
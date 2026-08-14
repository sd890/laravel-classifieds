{{-- resources/views/ads/show.blade.php --}}
@extends('web.layout.site')

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

         @if(auth()->user())
            @if(auth()->user()->favorites->contains($ad->id))
    <form action="{{ route('ads.favorite', $ad->id) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">❌ حذف از علاقه‌مندی</button>
    </form>
@else
    <form action="{{ route('ads.favorite', $ad->id) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">⭐ افزودن به علاقه‌مندی</button>
    </form>
@endif

@endif
 

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
                            data-bs-target="#photos" type="button" role="tab">
                         تصاویر
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chat-tab" data-bs-toggle="tab" 
                            data-bs-target="#chat" type="button" role="tab">
                        پیام
                                        </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mobile-tab" data-bs-toggle="tab" 
                            data-bs-target="#mobile" type="button" role="tab">
                        نمایش شماره آگهی دهنده
                                        </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" 
                            data-bs-target="#payment" type="button" role="tab">
                        پرداخت امن
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

                 {{--  تصاویر --}}
 
                 <div class="tab-pane fade" id="photos" role="tabpanel">
                    @if($images->isNotEmpty())
                        <div id="adPhotosCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($images as $key => $photo)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $photo->image) }}" 
                                            class="d-block w-100 rounded" 
                                            style="max-height: 400px; object-fit: contain;">
                                    </div>
                                @endforeach
                            </div>

                            {{-- کنترل‌ها --}}
                            <button class="carousel-control-prev" type="button" data-bs-target="#adPhotosCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#adPhotosCarousel" data-bs-slide="next" >
                                <span class="carousel-control-next-icon" ></span>
                            </button>
                        </div>
                    @else
                        <p class="text-muted">هیچ تصویری ثبت نشده است.</p>
                    @endif
                </div>

                  {{--  چت --}}
                <div class="tab-pane fade" id="chat" role="tabpanel">
                    @if(Auth::id())

                            <div class="messages flex-grow-1 overflow-auto p-3 border rounded">
                    @foreach($messages as $msg)
                        <div class="mb-2 {{ $msg->sender_id == Auth::id() ? 'text-end' : 'text-start' }}">
                            <div class="d-inline-block p-2 rounded 
                                {{ $msg->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }}">
                                <strong>{{ $msg->sender->name }}</strong><br>
                                {{ $msg->message }}
                            </div>
                            <div class="small text-muted">
                                {{ $msg->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- فرم ارسال پیام --}}
                <form action="{{route('ads.conversation',$ad->id)}}" method="post" class="d-flex mt-2">
                    @csrf
                    <input type="text" name="message" class="form-control me-2" placeholder="پیام خود را بنویسید...">
                    <button type="submit" class="btn btn-success">ارسال</button>
                </form>
                     
                @else
                    <a href="{{route('login')}}" class=" inline btn btn-success">برای گفتگو وارد  شوید</a>
            @endif
            </div> 

            {{--نمایش شماره آگهی دهنده--}}

                <div class="tab-pane fade" id="mobile" role="tabpanel">
                    
                @if(auth()->user() && $ad->contact_number)
                        
                    <span style="color:red">شماره تماس :</span>

                    {{ $ad->contact_number}}
                    
                    @elseif(auth()->user() && !$ad->contact_number)

                    <span style="color:red">آگهی دهنده شماره تماس وارد نکرده</span>
                    
             @else
               <a href="{{route('login')}}" class=" inline btn btn-success">برای نمایش شماره آگهی دهنده وارد شوید</a>

              @endif
                </div>

            <div class="tab-pane fade" id="payment" role="tabpanel">

			@if(auth()->user())
             @if(auth()->user()->email_verify==1 && auth()->user()->is_phone_verified==1)
                <form action="{{route('payment',$ad->id)}}" method="post" class="d-flex mt-2">
                    @csrf
                
                    <button type="submit" class="btn btn-success">پرداخت</button>
                </form>
                @endif
				
				@endif
            </div>
            </div>

            {{-- دکمه‌ها --}}

             
        
            
        </div>

      
    </div>
</div>



@endsection
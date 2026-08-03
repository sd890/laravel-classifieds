@extends('web.profile.layout.site')

@section('content')
<main class="main-content py-4">
    @include('admin.layout.errors')

    <div class="container">
        <div class="card shadow-sm col-md-6 col-12 mx-auto">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">اطلاعات کاربر <span class="text-warning">{{ $user->name }}</span></h3>
            </div>

            <div class="text-center mt-3">
                <figure class="avatar avatar-lg mx-auto">
                    <img src="{{ url('images/user/smallImages/'.$user->image) }}" class="rounded-circle" alt="تصویر کاربر">
                </figure>

                <div class="mt-3 d-flex gap-2 justify-content-center flex-wrap">
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> ویرایش اطلاعات
                    </a>

                    @if($user->email_verify == 0)
                    <form action="{{ route('send_code_email') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="bi bi-envelope-check"></i> تایید ایمیل
                        </button>
                    </form>
                    @else
                        <span class="badge bg-success">ایمیل تایید شد</span>
                    @endif

                    @if($user->is_phone_verified == 0)
                    <form action="{{ route('send.sms.code') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="bi bi-phone"></i> تایید موبایل
                        </button>
                    </form>
                    @else
                        <span class="badge bg-success">موبایل تایید شد</span>
                    @endif
                </div>
            </div>

            <div class="card-body mt-4">
                <div class="row mb-3">
                    <div class="col-4 fw-bold">نام:</div>
                    <div class="col-8 text-dark">{{ $user->name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-4 fw-bold">نام کاربری:</div>
                    <div class="col-8 text-dark">{{ $user->username }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-4 fw-bold">ایمیل:</div>
                    <div class="col-8 text-dark">{{ $user->email }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-4 fw-bold">موبایل:</div>
                    <div class="col-8 text-dark">{{ $user->mobile }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-4 fw-bold">درباره من:</div>
                    <div class="col-8 text-dark">{{ $user->bio }}</div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.avatar-lg img {
    width: 120px;
    height: 120px;
    object-fit: cover;
}
.card-header {
    border-bottom: 1px solid rgba(0,0,0,0.125);
}
</style>
@endsection

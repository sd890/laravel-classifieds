@extends('web.layout.site')

@section('content')
<main class="main-content py-5">
    @include('admin.layout.errors')

    <div class="container">
        <div class="card shadow-sm border-0 about-card">
            <div class="card-body p-5">

                <div class="text-center mb-4">
                    <h1 class="about-title">راه های ارتباطی با ما</h1>
                    <div class="about-divider"></div>
                </div>

                <p class="about-text">
                    شرکت نوین داده آگهی و تبلیغات با هدف ایجاد بستری مناسب برای
                    دسترسی تمامی کاربران ایران به آگهی‌ها و تبلیغات، این سامانه را
                    راه‌اندازی کرده است.
                </p>

                

                <div class="about-features mt-4">
                    <div class="feature-item">
                        ✅ ثبت و مدیریت آگهی از طریق پنل کاربری
                    </div>

                    <div class="feature-item">
                        حضوری:تهران-طالقانی-طالقانی 5
                    </div>

                    <div class="feature-item">
                        همراه:09121113232
                        09121112222
                    </div>

                    <div class="feature-item">
                   تلفن: 0213331212
                   0213434444
                    </div>

                    <div class="feature-item">
                     ایمیمل:support@Divar.ir
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
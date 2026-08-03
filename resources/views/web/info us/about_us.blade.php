@extends('web.layout.site')

@section('content')
<main class="main-content py-5">
    @include('admin.layout.errors')

    <div class="container">
        <div class="card shadow-sm border-0 about-card">
            <div class="card-body p-5">

                <div class="text-center mb-4">
                    <h1 class="about-title">درباره ما</h1>
                    <div class="about-divider"></div>
                </div>

                <p class="about-text">
                    شرکت نوین داده آگهی و تبلیغات با هدف ایجاد بستری مناسب برای
                    دسترسی تمامی کاربران ایران به آگهی‌ها و تبلیغات، این سامانه را
                    راه‌اندازی کرده است.
                </p>

                <p class="about-text">
                    بر همین اساس و با توجه به نیاز جامعه، این وب‌سایت طراحی شد تا
                    کاربران بتوانند آگهی‌های خود را به سادگی ثبت و منتشر کنند و از
                    امکانات متنوع برای مدیریت آگهی‌های خود بهره‌مند شوند.
                </p>

                <p class="about-text">
                    این سایت از بخش‌های مختلفی برای ارائه بهتر آگهی‌ها طراحی شده
                    است تا تجربه‌ای آسان و مطمئن برای کاربران فراهم شود.
                </p>

                <div class="about-features mt-4">
                    <div class="feature-item">
                        ✅ ثبت و مدیریت آگهی از طریق پنل کاربری
                    </div>

                    <div class="feature-item">
                        📊 مشاهده تعداد بازدید آگهی‌ها
                    </div>

                    <div class="feature-item">
                        ✏️ ویرایش و بروزرسانی آگهی‌ها
                    </div>

                    <div class="feature-item">
                        💬 گفتگوی مستقیم با آگهی‌دهنده
                    </div>

                    <div class="feature-item">
                        🔒 پرداخت امن و مطمئن از طریق سایت
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
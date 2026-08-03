<header class="site-header">
    <div class="container">
        <div class="logo">
            <a href="{{ url('/') }}">لوگوی سایت</a>
        </div>

        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="{{ url('/') }}">صفحه اصلی</a></li>
                <li><a href="{{ url('/ads') }}">آگهی‌ها</a></li>
                <li><a href="{{ url('/about') }}">درباره ما</a></li>
                <li><a href="{{ url('/contact') }}">تماس با ما</a></li>
                @auth
                    <li><a href="{{ url('/dashboard') }}">پنل کاربری</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">خروج</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">ورود</a></li>
                    <li><a href="{{ route('register') }}">ثبت نام</a></li>
                @endauth
            </ul>
        </nav>

        <div class="menu-toggle" id="menuToggle">
            ☰
        </div>
    </div>
</header>

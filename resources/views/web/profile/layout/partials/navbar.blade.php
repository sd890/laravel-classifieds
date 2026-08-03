<header class="site-header">
    <div class="container">
        <div class="logo">
            <a href="{{ url('/') }}">لوگوی سایت</a>
        </div>

        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="{{ url('/') }}">صفحه اصلی</a></li>
                <li><a href="{{ url('dashboard/my_ads') }}">آگهی های من</a></li>
                <li><a href="{{ url('dashboard/favorites_ads') }}">علاقه‌مندی ها</a></li>
                <li><a href="{{url('dashboard/my_ads/create')}}">افزودن آگهی</a></li>
                <li><a href="{{ url('dashboard/profile') }}">پنل کاربری</a></li>
               <li><a href="{{url('dashboard/chat')}}">چت</a></li>
                @auth
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

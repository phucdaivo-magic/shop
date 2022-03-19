<!-- <div class="bg-white" style="height: 20px; position: relative; z-index: 1021">
</div> -->
<div class="sticky-top bg-white header animate__backInRight">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white menu-header p-0">
            <a class="navbar-brand" href="{{ url('') }}">
                @if (isset($headerSetting) && isset($headerSetting->logo)) <img class="logo lazy"
                        data-src="{{ url($headerSetting->logo) }}" alt="Kim Oanh Real Estate - Dự án Đất nền Bình Dương - Đồng Nai, HCM">
                @endif
            </a>

            <div class="d-flex align-items-center">

                <div class="d-flex flex-column">
                    @if ($headerSetting && $headerSetting->phone)
                        <a class="menu-header-phone d-flex d-lg-none align-items-center px-2"
                            href="tel:{{ $headerSetting->phone }}">
                            <div class="mr-2"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            <div>{{ $headerSetting->phone }}</div>
                        </a>
                    @endif

                    @if ($headerSetting && $headerSetting->phone_last)
                        <a class="menu-header-phone d-flex d-lg-none align-items-center px-2"
                            href="tel:{{ $headerSetting->phone_last }}">
                            <div class="mr-2"><i class="fa fa-phone" aria-hidden="true"></i></div>
                            <div>{{ $headerSetting->phone_last }}</div>
                        </a>
                    @endif
                </div>

                <button class="navbar-toggler d-flex d-lg-none " data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @if (url()->current() === route('user.home')) active @endif"">
                        <a class=" nav-link" href="{{ route('user.home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item @if (url()->current() === route('user.projects')) active @endif">
                        <a class="nav-link" href="{{ route('user.projects') }}">Dự án</a>
                    </li>
                    <li class="nav-item @if (url()->current() === route('user.about')) active @endif"">
                        <a href="{{ route('user.about') }}" class="nav-link">Giới thiệu</a>
                    </li>
                    <li class="nav-item @if (url()->current() === route('user.image')) active @endif"">
                        <a href=" {{ route('user.image') }}" class="nav-link">Hình ảnh</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link">Tin Tức</a>
                    </li> --}}
                    <li class="nav-item @if (url()->current() === route('user.contact.index')) active @endif"">
                        <a href=" {{ route('user.contact.index') }}" class="nav-link">Liên hệ</a>
                    </li>
                </ul>
            </div>

            <div class="d-none d-lg-block">
                @if ($headerSetting && $headerSetting->phone)
                    <a class="menu-header-phone d-lg-flex" href="tel:{{ $headerSetting->phone }}">
                        <div class="mr-2"><i class="fa fa-phone" aria-hidden="true"></i></div>
                        <div>{{ $headerSetting->phone }}</div>
                    </a>
                @endif
                @if ($headerSetting && $headerSetting->phone_last)
                    <a class="menu-header-phone  d-none d-lg-flex" href="tel:{{ $headerSetting->phone_last }}">
                        <div class="mr-2"><i class="fa fa-phone" aria-hidden="true"></i></div>
                        <div>{{ $headerSetting->phone_last }}</div>
                    </a>
                @endif
            </div>
        </nav>
    </div>
</div>

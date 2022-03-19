<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('user.components.head')
</head>

<body>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "102397602307863");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>


    @php
        $slideImages = App\Models\Baner::orderBy('sort', 'ASC')
            ->where('active', true)
            ->get();

        use App\Services\User\SettingService;
        $setting = new SettingService();
        $headerSetting = $setting->getHeaderSetting();
    @endphp
    @include('user.components.menu')
    <div class="banner">
        <div class="carousel">
            @if ($slideImages->count() > 1)
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($slideImages as $key => $image)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($slideImages as $key => $image)
                            <div class="carousel-item @if ($key == 0) active @endif">
                                <img class="d-block w-100 lazy" data-src="{{ url($image->image) }}"
                                    alt="Kim Oanh Real Estate - Dự án Đất nền Bình Dương - Đồng Nai, HCM">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @elseif($slideImages->count() == 1)
                <img class="d-block w-100 lazy" data-src="{{ url($slideImages[0]->image) }}" alt="">
            @endif
        </div>
        @yield('breadcrumb')
    </div>

    @yield('content')
    @include('user.components.footer')
    <div class="view-load show">
        <div class="fxs-progress-dots">
            <div class="fxs-progress-dots-dot"></div>
            <div class="fxs-progress-dots-dot"></div>
            <div class="fxs-progress-dots-dot"></div>
        </div>
    </div>
    <div id="back-to-top">
        <a href="#" class="btn btn-light btn-lg back-to-top" role="button">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
    @isset($headerSetting->phone)
        {{-- <a class="zalo" href="https://zalo.me/{{ $headerSetting->phone }}">
        <div></div>
    </a> --}}
    @endisset
    <div id="button-contact-vr" aria-hidden="false">
        <!-- zalo -->
        <div id="zalo-vr" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a target="_blank" href="https://zalo.me/{{ $headerSetting->phone }}">
                        <img src="{{ asset('images/zalo.png') }}">
                    </a>
                </div>
            </div>
        </div>
        <!-- end zalo -->

        <!-- Phone -->
        <div id="phone-vr" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a href="tel:{{ $headerSetting->phone }}">
                        <img src="{{ asset('images/phone.png') }}">
                    </a>
                </div>
            </div>
        </div>
        <div class="phone-bar">
            <a href="tel:{{ $headerSetting->phone }}">
                <span class="text-phone">{{ $headerSetting->phone }}</span>
            </a>
        </div>

        <!-- end phone -->
    </div>
    @include('user.components.script')
</body>

</html>

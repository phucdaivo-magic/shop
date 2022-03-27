@php
$categoryList = App\Models\Category::where('home', true)
    ->orderBy('sort', 'ASC')
    ->get();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap&subset=vietnamese"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('site_admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('pe-icon-7-stroke/css/helper.css') }}">
    <link rel="stylesheet" href="{{ mix('site/css/site.css') }}">
</head>

<body>
    <div id="app">
        <div class="sticky-top bg-white" :style="{ boxShadow: '0 0 3px 0 rgb(0 0 0 / 12%)'}">
            <div class="header position-relative">
                <div class="logo-box d-flex justify-content-center align-items-center">
                    <div class="text-danger">
                        <div class="pe-7s-home text-danger"></div>LOGO
                    </div>
                </div>
                <div class="container d-flex justify-content-end align-items-center">
                    <button class="navbar-toggler mr-auto ml-0 position-relative d-lg-none" type="button"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="pe-7s-menu"></span>
                    </button>
                    <header-icon icon="pe-7s-like" :count="favorite" :link="'{{ route('site.favorite') }}'">
                    </header-icon>
                    <header-icon icon="pe-7s-shopbag" :count="cart" :link="'{{ route('site.cart') }}'"></header-icon>
                </div>
            </div>
            <div class="div"></div>
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    {{-- <a class="navbar-brand" href="{{ route('site.index') }}">Navbar</a> --}}
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto justify-content-center w-100">
                            @foreach ($categoryList as $item)
                                @if ($item->url)
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold"
                                            href="{{ $item->url }}">{{ $item->name }}</a>
                                    </li>
                                @elseif($item->categories->count())
                                    <li class="nav-item dropdown">
                                        <a class="nav-link font-weight-bold" href="#" id="navbarDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $item->name }}
                                            <div class="pe-7s-angle-down icon-angle"></div>
                                        </a>
                                        <div class="dropdown-menu rounded-0" aria-labelledby="navbarDropdown">
                                            @foreach ($item->categories as $itemChild)
                                                <a class="dropdown-item"
                                                    href="{{ $itemChild->url ? $itemChild->url : route('site.category.parent', [$item->slug, $itemChild->slug]) }}">
                                                    {{ $itemChild->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold"
                                            href="{{ route('site.category', $item->slug) }}">{{ $item->name }}</a>
                                    </li>
                                @endif
                            @endforeach

                            <!-- <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li> -->
                        </ul>
                        <form hidden class="form-inline my-2 my-lg-0" action="{{ route('site.cart') }}">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>

        @yield('content')

        <!-- <div class="footer">
            <img class="w-100" src="http://diaoc.phucdaivo.com/uploads/images/project/image/1647669327_Screen%20Shot%202022-03-19%20at%2012.54.17.png" alt="">
        </div> -->
        <div style="background: #f6f6f8;" class="pt-4 mt-3">
            <div class="container pt-4 pb-2 text-muted">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="text-muted">
                                <div class="pe-7s-home text-muted display-3"></div>LOGO
                            </div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="mr-2 mt-1">
                                <div class="pe-7s-map-marker text-muted display-5"></div>
                            </div>
                            <div>
                                Trường Chinh, Tây Thạnh, Quận Tân Phú, TP.Hồ Chí Minh
                            </div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="mr-2 mt-1">
                                <div class="pe-7s-mail text-muted display-5"></div>
                            </div>
                            <div>daihandaiphuc@gmail.com</div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="mr-2 mt-1">
                                <div class="pe-7s-call text-muted display-5"></div>
                            </div>
                            <div>0367102462</div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="mr-2 mt-1">
                                <div class="pe-7s-clock text-muted display-5"></div>
                            </div>
                            <div>Giờ làm việc: 8h-19h (T2 – T7), 9h-16h (Chủ Nhật)</div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        @php
                            $footerList = App\Models\Category::where('footer', true)
                                ->orderBy('sort', 'ASC')
                                ->get();
                        @endphp
                        <h4 class="text-dark font-weight-bold">SẢN PHẨM</h4>
                        @foreach ($footerList as $menu)
                            @if ($menu->category)
                                <a class="d-block mt-2 text-muted"
                                    href="{{ route('site.category.parent', [$menu->category->slug, $menu->slug]) }}">{{ $menu->name }}</a>
                            @else
                                <a class="d-block mt-2 text-muted"
                                    href="{{ route('site.category', [$menu->slug]) }}">{{ $menu->name }}</a>
                            @endif
                        @endforeach
                    </div>
                    @php
                        $aboutList = App\Models\About::where('active', true)
                            ->orderBy('sort', 'ASC')
                            ->get();
                    @endphp
                    <div class="col-md-3 mt-3">
                        <h4 class="text-dark font-weight-bold">THÔNG TIN</h4>
                        @foreach ($aboutList as $about)
                            <a class="d-block text-muted mt-2"
                                href="{{ route('site.about', $about->slug) }}">{{ $about->name }}</a>
                        @endforeach
                        <a class="d-block text-muted mt-2" href="{{ route('site.contact') }}">Liên hệ</a>
                    </div>

                    <div class="col-md-3 mt-3">
                        <h4 class="text-dark font-weight-bold">LIÊN KẾT NHANH</h4>
                        <a class="d-block mt-2">Theo dõi đơn hàng</a>
                        <a class="d-block mt-2">FAQs</a>
                    </div>
                </div>

                @php
                    $menuList = App\Models\Category::where('active', true)
                        ->whereNull('category_id')
                        ->orderBy('sort', 'ASC')
                        ->get();

                    $tradeMarkList = App\Models\Trademark::where('active', true)->get();
                @endphp
                {{-- <div class="text-left font-weight-bold pt-4 -p-2">THƯƠNG HIỆU SẢN PHẨM</div> --}}

            </div>
        </div>
        <ul class="list-trademarks d-flex p-1 my-0 container">
            <li class="p-2" style="list-style-type: none"><div class="text-left font-weight-bold">THƯƠNG HIỆU:</div></li>
            @foreach ($tradeMarkList as $tradeMark)
                <li style="list-style-type: none" class="p-1">
                    <a class="text-muted btn btn-light btn-sm" href="{{ route('site.trademark', $tradeMark->slug) }}">
                        {{ $tradeMark->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        window.BASE_URL = '{{ url('') }}';
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="{{ mix('js/site.js') }}"></script>
</body>

</html>

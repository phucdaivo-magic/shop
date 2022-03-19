@extends('layouts.user')

@section('breadcrumb')
    @include('user.components.breadcrumb', [
    'breadcrumbs' => [
    [
    'name' => 'Giới thiệu'
    ]
    ]
    ])
@endsection

@section('content')
    <div class="about">
        <div class="cs-title text-center position-relative mt-5">
            THÔNG ĐIỆP TỔNG GIÁM ĐỐC
        </div>

        <div class="container first">
            <div class="row">
                @foreach ($about['overviews'] ?? [] as $item)
                    <div class="col-12 col-lg-7">
                        <div class="about-content">
                            <div class="quote-content content">
                                {!! $item->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="about-img">
                            <img class="lazy" data-src="{{ $item->image }}"
                                alt="Thông điệp tổng giám đốc">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="activity">
        <div class="cs-title text-center position-relative mt-5">
            LĨNH VỰC HOẠT ĐỘNG
        </div>
        <div class="container">
            <div class="row">
                @foreach ($about['activities'] ?? [] as $item)
                    <div class="col-12 col-lg-4 mb-3">
                        <div class="box">
                            <img class="lazy" data-src="{{ url($item->image) }}" alt="Kim Oanh Real Estate - Dự án Đất nền Bình Dương - Đồng Nai, HCM">
                            <h3>{{ $item->title }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="vision">
        <div class="cs-title text-center position-relative mt-5">
            TẦM NHÌN SỨ MỆNH
        </div>
        <div class="container">
            <div class="row">
                @foreach ($about['visions'] ?? [] as $item)
                <div class="col-12 col-lg-3 mb-3">
                    <div class="box">
                        <img class="lazy" data-src="{{ url($item->image) }}" alt="Kim Oanh Real Estate - Dự án Đất nền Bình Dương - Đồng Nai, HCM">
                        <h3>{{ $item->title }}</h3>
                        {!! $item->content !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="map mb-5">
        <div class="cs-title text-center position-relative mt-5">
            SƠ ĐỒ TỔ CHỨC
        </div>
        <div class="container">
            @foreach ($about['maps'] ?? [] as $item)
            <div class="row">
                <img class="w-100 lazy" data-src="{{ url($item->image) }}" alt="Kim Oanh Real Estate - Dự án Đất nền Bình Dương - Đồng Nai, HCM">
            </div>
            @endforeach
        </div>
    </div>
@endsection

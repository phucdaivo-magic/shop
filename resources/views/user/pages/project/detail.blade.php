@extends('layouts.user')

@section('breadcrumb')
    @include('user.components.breadcrumb', [
    'breadcrumbs' => [
    [
    'name' => $project->project_type->name,
    'url' => route('user.projects.type', $project->project_type->slug)
    ],
    [
    'name' => $project->name,
    ]
    ]
    ])
@endsection

@section('content')
    <div class="cs-title text-center position-relative">
        <span class="catalog-tmp" id="section-main"></span>
        TỔNG QUAN
    </div>

    @include('user.components.catalog_list')

    <div class="max-container overview">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mb-2">
                    <img class="image lazy" data-src="{{ asset($project->image) }}" alt="Kim Oanh Real Estate - Dự án Đất nền Bình Dương - Đồng Nai, HCM">
                </div>
                <div class="col-12 col-lg-6">
                    <div class="text-justify">
                        {!! $project->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($project->project_catalogs as $catalog)
        <div>
            <div class="catalog-section pt-4" id="section-{{ $catalog->id }}">
                <span class="catalog-tmp"></span>
                <div class="container">
                    <h2 class="catalog-title">{{ $catalog->name }}</h2>
                </div>
                <div>
                    @foreach ($catalog->project_properties as $property)
                        <div class="catalog-property">
                            <div class="container">
                                <div class="row">
                                    @if (empty($property->image))
                                        <div class="col-12">
                                            @include('user.components.title_property', ['title' => $property->name])
                                        </div>
                                    @elseif(empty($property->content))
                                        <div class="col-12">
                                            @include('user.components.title_property', ['title' => $property->name])
                                            <img class="w-100 lazy" data-src="{{ asset($property->image) }}" alt="Kim Oanh Real Estate - Dự án Đất nền Bình Dương - Đồng Nai, HCM">
                                        </div>
                                    @elseif(!empty($property->image) && !empty($property->content))
                                        <div class="col-12 col-lg-5">
                                            @include('user.components.title_property', ['title' => $property->name])
                                            <div class="property-content text-justify">
                                                {!! $property->content !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-7">
                                            <img class="w-100 lazy" data-src="{{ asset($property->image) }}" alt="Kim Oanh Real Estate - Dự án Đất nền Bình Dương - Đồng Nai, HCM">
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        {!! $property->video !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    @if (!$project->project_images->isEmpty())
        <div id="section-image">
            <div class="container catalog-section pt-3 pb-3">
                @include('user.components.title_property', ['title' => 'Hình ảnh'])
                <div class="row image-list">
                    @foreach ($project->project_images->where('active', true) as $image)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            @include('user.components.project_image', [
                                'title' => 'Hình ảnh - '.$image->project->name,
                                'url' => asset($image->image)
                                ])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="contact e-filter-white"
        style="background-image: url('https://diaockimoanh.com.vn/Data/Sites/1/media/gioi_thieu/bg.jpg')">
        <div class="container py-5 px-3">
            <div class="cs-title text-center position-relative pt-0">
                Đăng kí nhận thông tin dự án
            </div>
            <form action="{{ route('user.contact') }}" method="POST">
                @include('user.components.form_contact')
                <input hidden type="text" name="project_id" value="{{ $project->id }}">
                <button class="cs-button btn btn-primary position-relative px-5">Gửi</button>
            </form>
        </div>
    </div>

@endsection

@extends('layouts.user')

@section('breadcrumb')
    @include('user.components.breadcrumb', [
    'breadcrumbs' => [
    [
    'name' => 'Hình ảnh'
    ]
    ]
    ])
@endsection


@section('content')
    <div class="image-page">
        <div class="cs-title text-center position-relative mt-5">
            HÌNH ẢNH
        </div>
        <div id="section-image">
            <div class="container catalog-section pt-3">
                <div class="row image-list">
                    @foreach ($imageList as $image)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            @include('user.components.project_image', [
                            'title' => 'Hình ảnh - '.$image->project->name,
                            'url' => asset($image->image)
                            ])
                        </div>
                    @endforeach
                </div>
                <div class="cs-pagination d-flex justify-content-center">
                    {{ $imageList }}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.user')

@section('breadcrumb')
    @include('user.components.breadcrumb')
@endsection

@section('content')
    <div>
        <div class="cs-title text-center position-relative mt-5">
            Dự án của chúng tôi
        </div>
        <div class="container">
            <div class="row">
                @isset($projectList[0])
                    <div class="col-sm-6 col-12 mb-4 col-lg-8 d-lg-block d-none">
                        @include('user.components.project_card', [
                        'href' => route('user.project', $projectList[0]->slug),
                        'image' => asset($projectList[0]->image),
                        'name' => $projectList[0]->name
                        ])
                    </div>
                @endisset

                <div class="col-sm-6 col-12 mb-4 col-lg-4 justify-content-between flex-column d-lg-flex d-none">
                    @isset($projectList[1])
                        @include('user.components.project_card', [
                        'href' => route('user.project', $projectList[1]->slug),
                        'image' => asset($projectList[1]->image),
                        'name' => $projectList[1]->name
                        ])
                    @endisset

                    @isset($projectList[2])
                        @include('user.components.project_card', [
                        'href' => route('user.project', $projectList[2]->slug),
                        'image' => asset($projectList[2]->image),
                        'name' => $projectList[2]->name
                        ])
                    @endisset

                </div>
                @foreach ($projectList as $key => $project)
                    <div class="col-sm-6 col-12 mb-4 col-lg-4  @if ($key == 0 || $key == 1 || $key == 2) d-lg-none @endif">
                        @include('user.components.project_card', [
                        'href' => route('user.project', $project->slug),
                        'image' => asset($project->image),
                        'name' => $project->name
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div>
        <div class="cs-title text-center position-relative mt-5">
            Hình ảnh
        </div>
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
        </div>
    </div>

    <div class="contact pb-5">
        <div class="cs-title text-center position-relative mt-5">
            Liên hệ với chúng tôi
        </div>
        <div class="container">
            <form action="{{ route('user.contact') }}" method="POST">
                @include('user.components.form_contact')
                <button class="cs-button btn btn-primary position-relative px-5">Gửi</button>
            </form>
        </div>
    </div>
@endsection

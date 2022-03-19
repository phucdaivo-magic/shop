@extends('layouts.user')

@section('breadcrumb')
    @include('user.components.breadcrumb', [
    'breadcrumbs' => [
    [
    'name' => $projectType->name ?? 'Tất cả dự án',
    ]
    ]
    ])
@endsection

@section('content')
    <div class="cs-title text-center" id="project-type">
        Dự án
    </div>
    <div class="container">
        <div class="project-catalog">
            <ul class="pb-3 pt-1 px-0">
                <li>
                    <a @isset($projectType) @else class="active" @endisset
                        href="{{ route('user.projects', '#project-type') }}">Tất cả</a>
                </li>
                @foreach ($projectTypeList as $key => $type)
                    <li>
                        <a @if (isset($projectType) && $projectType->id === $type->id) class="active" @endisset
                            href="{{ route('user.projects.type', $type->slug) . '#project-type' }}">{{ $type->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
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
        <div class="cs-pagination d-flex justify-content-center">
            {{ $projectList }}
        </div>
    </div>
@endsection

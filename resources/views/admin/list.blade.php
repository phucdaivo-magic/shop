@extends('admin.layouts.base')

@section('title', 'Title Page')

@section('sidebar')
    @include('admin.layouts.slidebar')
@endsection

@section('content')
    @php
    $indexSearch = collect($data['header'])->search(function ($option) {
        return isset($option['search']);
    });
    $hasSearch = $indexSearch === 0 || $indexSearch > 0;
    @endphp

    <div @if ($hasSearch) class="has-search" @endif>
        <a class="btn btn-sms btn-success mb-2" href="{{ Request::url() }}/form" type="submit"><i
                class="fa fa-plus"></i> Thêm mới</a>

        @if ($hasSearch)
            <div class="card card-search">
                <div class="card-header">
                    <i class="icons cui-magnifying-glass"></i>
                    Danh sách
                    <span class="badge badge-pill badge-danger float-right">{{ $data['tableData']->total() }}</span>
                </div>
                <form class="card-body" action="">
                    @if (request()->has('per_page'))
                        <input type="num" name="per_page" value="{{ request('per_page') }}" hidden>
                    @endif
                    <div class="form-group row">
                        @foreach ($data['header'] as $option)
                            @php
                                $searchName = $option['search']['name'] ?? $option['key'];
                            @endphp
                            @if (isset($option['search']))
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label class="mr-sm-2 col-form-label-sm mb-0 pb-0" for="inlineFormCustomSelect">
                                        {{ $option['search']['title'] ?? $option['title'] }}
                                    </label>

                                    @if (isset($option['search']['type']))
                                        @switch($option['search']['type'])
                                            {{-- CHECKBOX --}}
                                            @case('checkbox')
                                                @php
                                                    $searchName = $searchName . '_eq';
                                                @endphp
                                                <div class="pt-1">
                                                    <label class="switch switch-pill switch-sm switch-success">
                                                        <input id="{{ $searchName }}" name="{{ $option['key'] . '_eq' }}"
                                                            class="switch-input" type="checkbox"
                                                            {{ request($searchName) ? 'checked' : '' }}>
                                                        <span class="switch-slider"></span>
                                                    </label>
                                                </div>
                                            @break

                                            {{-- SELECT --}}
                                            @case('select')
                                                @php
                                                    $searchName = $searchName == 'per_page' ? $searchName : $searchName . '_eq';
                                                @endphp
                                                <select id="{{ $searchName }}" value="{{ request($searchName) }}"
                                                    {!! isset($option['search']['attrs']) ? generateAtribute($option['search']['attrs']) : '' !!} class="form-control" name="{{ $searchName }}">
                                                    <option value="">Tất cả</option>
                                                    @foreach ($option['search']['dataSource'] as $op)
                                                        <option @if ($op['id'] == request($searchName)) selected @endif
                                                            value="{{ isset($option['search']['map']) ? $op[$option['search']['map'][0]] : $op['id'] }}">
                                                            {{ isset($option['search']['map']) ? $op[$option['search']['map'][1]] : $op['id'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @break

                                            {{-- EQ --}}
                                            @case('eq')
                                                @php
                                                    $searchName = $searchName . '_eq';
                                                @endphp
                                                {{-- Input --}}
                                                <input value="{{ request($searchName) }}" type="text" name="{{ $searchName }}"
                                                    class="form-control" placeholder="{{ $option['title'] }}">
                                            @break

                                            @default
                                                @php
                                                    $searchName = $searchName . '_cont';
                                                @endphp
                                                {{-- Input --}}
                                                <input value="{{ request($searchName) }}" type="text" name="{{ $searchName }}"
                                                    class="form-control" placeholder="{{ $option['title'] }}">
                                        @endswitch
                                    @else
                                        {{-- Input --}}
                                        @php
                                            $searchName = $searchName . '_cont';
                                        @endphp
                                        <input value="{{ request($searchName) }}" type="text" name="{{ $searchName }}"
                                            class="form-control" placeholder="{{ $option['title'] }}">
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-danger btn-sm ml-auto d-block"
                            @if (request()->has('per_page'))
                            onClick="window.location.href='{{ url()->current() }}?per_page={{ request('per_page') }}'">
                            @else
                            onClick="window.location.href='{{ url()->current() }}'">
                            @endif
                            <i class="fa fa-rotate-left mr-1"></i>Reset</button>
                        <button class="btn btn-success btn-sm ml-1 d-block">
                            <i class="icons cui-magnifying-glass mr-1"></i>Tìm kiếm</button>
                    </div>

                </form>
            </div>
        @endif
        <div class="card cs-card card-accent-primary card-result">
            @if (!$hasSearch)
                <div class="card-header">
                    <i class="icon-list"></i> Danh sách
                    <span class="badge badge-pill badge-danger float-right">{{ $data['tableData']->total() }}</span>
                </div>
            @endif

            <div class="card-body">
                <div class="d-flex mx-1 my-2">
                    @include('admin.components.pagination')
                    <select value="5" class="form-control" style="width: 75px" data-init-plugin="select2"
                        onChange="window.location.href='{{ url()->current() }}?per_page='+this.value">
                        <option value="1" @if (request('per_page') == 1) selected @endif>1</option>
                        <option value="5" @if (request('per_page') == 5) selected @endif>5</option>
                        <option value="10" @if (request('per_page', 10) == 10) selected @endif>10</option>
                        <option value="50" @if (request('per_page') == 50) selected @endif>50</option>
                        <option value="100" @if (request('per_page') == 100) selected @endif>100</option>
                    </select>
                </div>
                <div style="overflow: auto">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                @foreach ($data['header'] as $option)
                                    @if (isset($option['view']))
                                        <th>
                                            {!! isset($option['title']) ? $option['title'] : '' !!}
                                        </th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['tableData'] as $item)
                                <tr>
                                    @foreach ($data['header'] as $option)
                                        @if (isset($option['view']))
                                            @if (is_callable($option['view']))
                                                <td>
                                                    {!! call_user_func($option['view'], $item) !!}
                                                </td>
                                                {{-- type --}}
                                            @elseif(isset($option['view']['type']))
                                                <td {!! isset($option['view']['attrs']) ? generateAtribute($option['view']['attrs']) : '' !!}>
                                                    @switch($option['view']['type'])
                                                        @case('checkbox')
                                                            {{-- @include('admin.components.checkbox') --}}
                                                            @include(
                                                                'admin.components.toggle'
                                                            )
                                                        @break

                                                        @case('action')
                                                            @include(
                                                                'admin.components.action'
                                                            )
                                                        @break

                                                        @case('image')
                                                            @include('admin.components.image')
                                                        @break

                                                        @case('color')
                                                            <div class="rounded"
                                                                style="border: 1px solid rgba(0,0,0,0.2);width: 60px; height: 30px; background: {{ $item[$option['key']] }} ">
                                                            </div>
                                                        @break

                                                        @case('include')
                                                            @include($option['view']['path'])
                                                        @break

                                                        @default
                                                            @case('xss')
                                                                {{ $item[$option['key']] }}
                                                            @break
                                                        @endswitch
                                                    </td>
                                                @else
                                                    <td {!! isset($option['view']['attrs']) ? generateAtribute($option['view']['attrs']) : '' !!}>
                                                        @if ($option['key'] == 'id')
                                                            <a
                                                                href="{{ url()->current() . '?id_eq=' . $item[$option['key']] }}">{!! $item[$option['key']] !!}</a>
                                                        @else
                                                            {!! $item[$option['key']] !!}
                                                        @endif

                                                    </td>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex">
                    @include('admin.components.pagination')
                    <select value="5" class="form-control" style="width: 75px" data-init-plugin="select2"
                        onChange="window.location.href='{{ url()->current() }}?per_page='+this.value">
                        <option value="1" @if (request('per_page') == 1) selected @endif>1</option>
                        <option value="5" @if (request('per_page') == 5) selected @endif>5</option>
                        <option value="10" @if (request('per_page', 10) == 10) selected @endif>10</option>
                        <option value="50" @if (request('per_page') == 50) selected @endif>50</option>
                        <option value="100" @if (request('per_page') == 100) selected @endif>100</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.col-->
    @endsection

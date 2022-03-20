@extends('admin.layouts.base')

@section('title', 'Title Page')

@section('sidebar')
    @include('admin.layouts.slidebar')
@endsection

@section('content')
    <div>
        <a class="btn btn-sms btn-success mb-2" href="{{ Request::url() }}/form" type="submit"><i
                class="fa fa-plus"></i> Thêm mới</a>
        @php
            $indexSearch = collect($data['header'])->search(function ($option) {
                return isset($option['search']);
            });
            $hasSearch = $indexSearch === 0 || $indexSearch > 0;
        @endphp

        @if ($hasSearch)
            <div class="card">
                <div class="card-header">
                    <i class="icons cui-magnifying-glass"></i>
                    Tìm kiếm
                </div>
                <form class="card-body" action="">
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
                                                    $searchName = $searchName . '_eq';
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
                    <button class="btn btn-success btn-sm ml-auto d-block"> <i
                            class="icons cui-magnifying-glass mr-"></i>Tìm kiếm</button>
                </form>
            </div>
        @endif
        <div class="card cs-card card-accent-primary">
            <div class="card-header">
                <i class="icon-list"></i> Danh sách
                <span class="badge badge-pill badge-danger float-right">{{ $data['tableData']->total() }}</span>
                {{-- @include('admin.components.pagination') --}}
            </div>
            <div class="card-body">
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

                                                        @default
                                                            @case('xss')
                                                                {{ $item[$option['key']] }}
                                                            @break
                                                        @endswitch
                                                    </td>
                                                @else
                                                    <td {!! isset($option['view']['attrs']) ? generateAtribute($option['view']['attrs']) : '' !!}>
                                                        {!! $item[$option['key']] !!}
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
                <div class="card-footer">
                    @include('admin.components.pagination')
                </div>
            </div>
        </div>
        <!-- /.col-->
    @endsection

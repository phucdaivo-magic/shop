<div class="cs-breadcrumb">
    <ol class="container m-auto d-flex align-items-center py-1">
        <li>
            <a href="{{ url('') }}">Trang chủ</a>
        </li>
        @isset($breadcrumbs)
            @foreach ($breadcrumbs as $breadcrumb)
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <li>
                    <a href="{{ $breadcrumb['url'] ?? '' }}">{{ $breadcrumb['name'] ?? '' }}</a>
                </li>
            @endforeach
        @endisset
    </ol>
</div>

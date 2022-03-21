@php
$menuList = App\Models\Category::where('active', true)
    ->whereNull('category_id')
    ->orderBy('sort', 'ASC')
    ->get();

$tradeMarkList = App\Models\Trademark::where('active', true)->get();
@endphp
<div class="text-left font-weight-bold py-2">DANH MỤC SẢN PHẨM</div>
<ul class="left-menu">
    @foreach ($menuList as $menu)
        <li class="">
            <a href="{{ route('site.category', [$menu->slug]) }}" class="d-block">
                {{-- <i class="fa fa-filter mr-2" aria-hidden="true"></i> --}}
                + {{ $menu->name }}
                @if (!!$menu->products->count())
                    <span class="badge badge-light badge-pill">{{ $menu->products->count() }}</span>
                @endif
            </a>
        </li>
        <ul>
            @foreach ($menu->categories as $item)
                <li class="">
                    <a href="{{ route('site.category.parent', [$menu->slug, $item->slug]) }}">+ {{ $item->name }}</a>
                </li>
            @endforeach
        </ul>
    @endforeach
</ul>
<div class="text-left font-weight-bold pt-4 -p-2">THƯƠNG HIỆU SẢN PHẨM</div>
<ul class="list-trademark">
    @foreach ($tradeMarkList as $tradeMark)
        <li> <a class="text-muted" href="{{ route('site.trademark', $tradeMark->slug) }}">
                {{ $tradeMark->name }}
            </a>
        </li>
    @endforeach
</ul>

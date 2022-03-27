@php
$menuList = App\Models\Category::where('active', true)
    ->whereNull('category_id')
    ->orderBy('sort', 'ASC')
    ->get();

// $tradeMarkList = App\Models\Trademark::where('active', true)->get();
@endphp
<div class="text-left font-weight-bold py-2">DANH MỤC SẢN PHẨM</div>
<ul class="left-menu">
    @foreach ($menuList as $menu)
        <li class="">
            <a href="{{ route('site.category', [$menu->slug]) }}" class="d-block @if(route('site.category', [$menu->slug]) == url()->full()) active  @endif">
                {{-- <i class="fa fa-filter mr-2" aria-hidden="true"></i> --}}
                {{ $menu->name }}
            </a>
        </li>
        <ul>
            @foreach ($menu->categories as $item)
                <li class="">
                    <a href="{{ route('site.category.parent', [$menu->slug, $item->slug]) }}"  @if(route('site.category.parent', [$menu->slug, $item->slug]) == url()->full()) class="active"  @endif>{{ $item->name }}

                        @if (!!$item->products->count())
                        <span class="badge badge-light badge-pill">{{ $item->products->count() }}</span>
                    @endif</a>
                </li>
            @endforeach
        </ul>
    @endforeach
</ul>

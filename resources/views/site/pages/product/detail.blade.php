@php
$imageList = collect($product->images->where('active', true))->values();
@endphp
@extends('layouts.site')

@section('content')
<div class="container mt-4">
    <product :product="{{ $product }}">
        <template v-slot:image>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators" style="
                                                                            position: relative;
                                                                            top: 0;
                                                                            left: 0;
                                                                            display: flex;
                                                                            flex-direction: column;
                                                                            margin: 0;
                                                                        ">
                    @foreach ($imageList as $key => $image)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" style="cursor: pointer; width: 50px; height: 30px; min-width: 50px; min-height: 30px; background-image: url('{{ asset($image->image) }}');
                                                                                            background-size: cover; background-position: center; margin-bottom: 5px;" class="@if ($key == 0) active @endif">
                    </li>
                    @endforeach
                </ol>
                <div class="carousel-inner" style="
                                                                                position: absolute;
                                                                                top: 0;
                                                                                margin-left: 55px;
                                                                                width: calc(100% - 55px);">
                    @foreach ($imageList as $key => $image)
                    <div class="carousel-item @if ($key == 0) active @endif">
                        <img class="d-block w-100" src="{{ asset($image->image) }}" alt="First slide">
                    </div>
                    @endforeach
                </div>
            </div>
</div>
</template>
<template v-slot:about>
    <h1 style="font-size: 20px">{{ $product->name }}</h1>

</template>
<template v-slot:bottom>
    @if ($product->category)
    <p class="mt-4 mb-2">Danh m???c: <a href="{{ isset($product->category->category)? route('site.category.parent', [$product->category->category->slug, $product->category->slug]): route('site.category', $product->category->slug) }}">{{ $product->category->name ?? '' }}</a>
    </p>
    @endif

    @isset($product->trademark->name)
    <p class="mt-0 mb-2">Th????ng hi???u: <a href="{{ route('site.trademark', $product->trademark->slug) }}">{{ $product->trademark->name ?? '' }}</a>
    </p>
    @endif
</template>
</product>
<div class="div mt-3"></div>
<div class="p-3 tmp">
    {{-- {!!$product->description!!} --}}
    <div class="blog-content__box-content">
        <div class="box-outstanding-features">
            <div class="box-title">
                <h2>?????C ??I???M N???I B???T</h2>
            </div>
            <div class="box-content">
                <ul>
                    <li>????n Led RGB s???ng ?????ng,tho???i m??i tu??? ch???nh qua ???ng d???ng Xboom</li>
                    <li>??m thanh ???????c tu??? ch???nh b???i Meridian c??ng c??ng ngh??? Sound Boost khu???ch ?????i d???i ??m thanh </li>
                    <li>C??ng su???t 20W,h??? tr??? k???t n???i nhi???u loa c??ng l??c </li>
                    <li>Kh??ng n?????c IPX5 kh??ng lo n?????c,b???i x??m nh???p</li>
                    <li>Pin kh???ng 3900mAh cho th???i gian 24 gi??? s??? d???ng li??n t???c,s???c ?????y trong 5 gi???</li>
                    <ul> </ul>
                </ul>
            </div>
        </div>
        <div class="blog-content">
            <h2>LG XBoom Go PL7 - Loa Di???n m???o m???i ????a ??m nh???c ra cu???c s???ng</h2>
            <p>??m nh???c l?? y???u t??? gi??p b???n gi???m stress sau nh???ng ng??y l??m vi???c v?? h???c t???p m???t m???i. ????? t???n h?????ng tr???n v???n giai ??i???u c???a b???n nh???c b???n c???n c?? m???t chi???c <a href="https://cellphones.com.vn/thiet-bi-am-thanh/loa/lg.html" target="_blank">loa LG</a> c?? nh???ng t??nh n??ng hi???n ?????i v???a ph?? h???p khi s??? d???ng ??? nh?? v???a ph?? h???p l??c ??i d?? ngo???i c??ng v???i gia ????nh v?? b???n b??.&nbsp;<strong>Loa bluetooth LG XBoom Go PL7&nbsp;</strong>l?? m???t chi???c loa c?? di???n m???o m???i r???t b???t m???t, gi??p b???n t???n h?????ng m???t b???n nh???c m???t c??ch tuy???t v???i nh???t c?? th???.</p>
            <h3>Thi???t k??? nh??? g???n ch???t li???u cao c???p,&nbsp;trang b??? ????n led s???ng ?????ng</h3>
            <p>LG XBoom Go PL7 ???????c h??ng thi???t k??? d??ng tr??n d??i r???t nh??? g???n, t???ng tr???ng l?????ng loa si??u nh??? l??n ?????n 1,86kg. Gi??p ng?????i d??ng c?? th??? mang loa ??i b???t c??? n??i ????u m???t c??ch d??? d??ng. H??n th???, LG PL7 ???????c ph??? b??n ngo??i l?? l???p cao su cao c???p, ng?????i d??ng d??? d??ng c???m n???m m?? kh??ng s??? b??? tr?????t tay l??m r??i r???t loa. V???i ch???t li???u ???????c ph??? b??n ngo??i s??? gi??p cho loa h???n ch??? b??m b???n m??? h??i v?? v??n tay v?? lu??n l??m s???ch s??? v?? b??ng lo??ng cho chi???c loa.</p>
            <p><img class="cpslazy loaded" alt="Thi???t k??? nh??? g???n ch???t li???u cao c???p" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7.jpg"></p>
            <p>H??ng LG ???? trang&nbsp;b??? ????n led nhi???u m??u cho chi???c&nbsp;loa LG XBoom PL7 t???o n??n s??? s???ng ?????ng. H??n th??? ????n led c?? th??? thay ?????i theo giai ??i???u b??i h??t, t???o n??n v??? ngo??i b???t m???t v?? s??i ?????ng. B???n c?? th??? ??i???u ch???nh m??u s???c, t???c ????? c???a ????n led th??ng qua ???ng d???ng XBoom.&nbsp;Chi???c&nbsp;loa bluetooth XBoom Go PL7 gi??p ng?????i d??ng t???n h?????ng giai ??i???u c??? v??? th??? gi??c v?? th??nh gi??c.</p>
            <p><img class="cpslazy loaded" alt="trang b??? ????n led s???ng ?????ng" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-1.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-1.jpg"></p>
            <h3>T??ch h???p c??ng ngh???&nbsp;Meridian&nbsp;v?? Sound Boost, c??ng su???t ph??t 30W</h3>
            <p><strong>Loa LG XBoom Go PL7</strong> ???????c&nbsp;t??ch h???p c??ng ngh??? Meridian t???o ra ch???t l?????ng ??m thanh r???t tuy???t v???i. Khi b???n s??? h???u chi???c loa&nbsp;LG&nbsp;n??y m???i khi nghe nh???c l?? m???i l???n th?????ng th???c nh???ng ??m s???c phong ph?? v?? nh???ng ??m bass tr???m b???ng v?? ch??nh x??c ?????n t???ng n???t nh???c. H??n th???, chi???c&nbsp;<a href="https://cellphones.com.vn/thiet-bi-am-thanh/loa/loa-bluetooth.html" target="_blank">loa bluetooth</a> LG XBoom Go PL7 t??ch h???p&nbsp;Sound Boost gi??p loa khu???ch ?????i v?? m??? r???ng c??c d???i ??m thanh. B???n ch??? c???n nh???n n??t Sound Boost l?? c?? th??? m??? t??nh n??ng n??y v?? khu???y ?????ng ???????c kh??ng gian th?? gi??n.</p>
            <p><img class="cpslazy loaded" alt="T??ch h???p c??ng ngh??? Meridian v?? Sound Boost" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-2.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-2.jpg"></p>
            <p>Ngo??i ra v???i c??ng su???t ph??t 30W m??ng loa c?? th??? rung theo giai ??i???u c???a b??i h??t m?? b???n ??ang m??? tr??n loa t???o s??? s??i ?????ng v?? l??i cu???n m???i ng?????i h??a m??nh v??o ??m nh???c nh?? c??ch m?? loa rung chuy???n ?????ng theo nh???p ??i???u. K???t h???p v???i ????? rung m??n loa l?? ????n led ???????c s??ng nh???p nh??y v?? ch???y theo d???ng v??ng tr??n chuy???n ?????ng r???c r??? t???o n??n kh??ng gian s???ng ?????ng v???i nhi???u m??u s???c n???i b???t.</p>
            <p><img class="cpslazy loaded" alt="c??ng su???t ph??t 30W" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-3.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-3.jpg"></p>
            <h3>Dung l?????ng pin cao 3900 mAh s??? d???ng xuy??n su???t ?????n 24 ti???ng, kh??? n??ng ch???ng n?????c IPX5</h3>
            <p>B???n l?? ng?????i y??u th??ch ??m nh???c m?? th?????ng xuy??n c?? nh???ng chuy???n d?? ngo???i ????? gi???m stress c??ng v???i gia ????nh hay b???n b??. Nh???ng kho???nh kh???c ngh??? ng??i n??y, y???u t??? kh??ng th??? thi???u v???i b???n l?? m???t chi???c loa ????? b???n c??ng m???i ng?????i t???n h?????ng nh???ng giai ??i???u c???a b???n nh???c. Nh??ng ??i???u b???n lo l???ng r???ng pin c???a chi???c loa s??? kh??ng ????? ????? b???n s??? d???ng. ?????ng lo, chi???c <strong>LG PL7</strong> ???????c h??ng thi???t k??? dung l?????ng pin l??n ?????n 3900 mAh, gi??p b???n c?? th??? s??? d???ng loa li??n t???c trong v??ng 24h m?? kh??ng s??? b??? h???t pin, kh??ng b??? ng???t qu??ng cu???c vui c???a b???n.</p>
            <p><img class="cpslazy loaded" alt="Dung l?????ng pin cao 3900 mAh" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-4.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-4.jpg"></p>
            <p>B???n c?? nh???ng bu???i ti???c d?? ngo???i ngo??i tr???i, n??i c?? ????? ???m cao ?????c bi???t l?? n?????c. <strong>LG XBoom PL7</strong> ???????c trang b??? IPX5 kh??? n??ng ch???ng b???i, ch???ng n?????c v?? b???i b???n len l???i v??o b??n trong khi s??? d???ng. Gi??p ng?????i d??ng tho???i m??i s??? d???ng loa trong b???t k??? m??i tr?????ng nh?? th??? n??o c??ng kh??ng b??? ???nh h?????ng x???u ?????n chi???c loa.</p>
            <p><img class="cpslazy loaded" alt="kh??? n??ng ch???ng n?????c IPX5" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-5.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-5.jpg"></p>
            <h3>Bluetooth 5.0 t????ng th??ch v???i nhi???u thi???t b???, ??i???u khi???n d??? d??ng</h3>
            <p>V???i c??ng ngh??? bluetooth 5.0,&nbsp;loa LG PL7 s??? t????ng th??ch h???u h???t t???t c??? c??c thi???t b??? di ?????ng ph??? bi???n hi???n nay nh?? ??i???n tho???i, m??y t??nh b???ng, tivi, laptop,... B???n c?? th??? k???t n???i loa v???i c??c thi???t b??? di ?????ng c?? nh??n c???a m??nh ??? b???t k??? n??i ????u hay b???t c??? l??c n??o m?? kh??ng b??? gi???i h???n kh??? n??ng k???t n???i.</p>
            <p><img class="cpslazy loaded" alt="Bluetooth 5.0 t????ng th??ch v???i nhi???u thi???t b???" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-6.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-6.jpg"></p>
            <p><strong>Loa LG XBoom Go PL7</strong> ???????c h??ng thi???t k??? c??c n??t b???m r???t nh???y, gi??p ng?????i d??ng c?? th??? d??? d??ng th???c hi???n c??c thao t??c ??i???u ch???nh ph?? h???p v???i kh??ng gian th?? gi??n c???a b???n. H??n th???, ngo??i t??nh n??ng ??i???u khi???n b???ng n??t b???m loa bluetooth LG PL7 c??ng c?? t??nh n??ng ??i???u khi???n b???ng gi???ng n??i. ????? k??ch ho???t t??nh n??ng n??y b???n ch??? c???n b???m gi??? n??t ph??t nh???c trong v??ng 2 gi??y, m??n h??nh ??i???n tho???i s??? hi???n l??n t??nh n??ng Google Assistant tr??n ??i???n tho???i c?? h??? ??i???u h??nh Android ho???c Siri tr??n c?? h??? ??i???u h??nh iOS. B???n c?? th??? ??i???u khi???n b???t hay t???t nh???c v?? c??c ch???c n??ng kh??c m?? ch??? c???n d??ng l???nh b???ng gi???ng n??i.</p>
            <p><img class="cpslazy loaded" alt="??i???u khi???n d??? d??ng" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-7.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-7.jpg"></p>
            <h2>Mua&nbsp;loa bluetooth LG XBoom PL7 gi?? r???, ch???t l?????ng t???i CellphoneS</h2>
            <p>V???i nh???ng t??nh n??ng hi???n ?????i m?? loa LG XBoom PL7 s??? h???u nh?? kh??? n??ng ch???ng n?????c IPX5, nhi???u c??ng ngh??? ??m thanh hi???n ?????i ph??? bi???n nh???t hi???n nay. B???n c??n ch???n ch??? n???a m?? kh??ng s??? h???u ngay cho m??nh m???t chi???c loa LG. ?????n ngay Cellphones ????? mua cho m??nh <strong>LG XBoom PL7&nbsp; Go ch??nh h??ng</strong>, gi?? r??? c??ng v???i ch??nh s??ch b???o h??nh 12 th??ng c???a h??ng. B??n c???nh ????, b???n c??ng c?? th??? tham kh???o th??m <a href="https://cellphones.com.vn/loa-bluetooth-lg-xboom-go-pl2.html" target="_blank">loa LG XBoom Go PL2</a> ??ang c?? gi?? t???t t???i Cellphones.</p>
        </div>
    </div>
</div>
</div>


{{-- <script>
        var form = document.querySelector('#form-detail');

        form.addEventListener('submit', function(e) {
            console.log($('#form-detail').serializeArray());
            e.preventDefault();
            var form = $('#form-detail').serializeArray();

            var key = form.reduce((acc, cur) => {
                if(cur['name'] == "mount") {
                    return acc;
                } else {
                    return acc+=(acc ? "_" : '')+cur['name']+"_"+cur['value']
                }
            }, '')

            var cart = { [key]: Number($('#form-detail input[name=mount]').val())}

            var cartLocal = localStorage.getItem("cart") || '{}';

            cartLocal = JSON.parse(cartLocal);

            if(cartLocal[key]) {
                cartLocal[key] = cartLocal[key] + cart [key];
            } else {
                cartLocal = {...cartLocal, ...cart };
            }

            console.log(cartLocal);

            localStorage.setItem("cart", JSON.stringify(cartLocal));

            location.href = "/gio-hang"
        })
    </script> --}}
@endsection
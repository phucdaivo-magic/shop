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
    <p class="mt-4 mb-2">Danh mục: <a href="{{ isset($product->category->category)? route('site.category.parent', [$product->category->category->slug, $product->category->slug]): route('site.category', $product->category->slug) }}">{{ $product->category->name ?? '' }}</a>
    </p>
    @endif

    @isset($product->trademark->name)
    <p class="mt-0 mb-2">Thương hiệu: <a href="{{ route('site.trademark', $product->trademark->slug) }}">{{ $product->trademark->name ?? '' }}</a>
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
                <h2>ĐẶC ĐIỂM NỔI BẬT</h2>
            </div>
            <div class="box-content">
                <ul>
                    <li>Đèn Led RGB sống động,thoải mái tuỳ chỉnh qua ứng dụng Xboom</li>
                    <li>Âm thanh được tuỳ chỉnh bởi Meridian cùng công nghệ Sound Boost khuếch đại dải âm thanh </li>
                    <li>Công suất 20W,hỗ trợ kết nối nhiều loa cùng lúc </li>
                    <li>Kháng nước IPX5 không lo nước,bụi xâm nhập</li>
                    <li>Pin khủng 3900mAh cho thời gian 24 giờ sử dụng liên tục,sạc đầy trong 5 giờ</li>
                    <ul> </ul>
                </ul>
            </div>
        </div>
        <div class="blog-content">
            <h2>LG XBoom Go PL7 - Loa Diện mạo mới đưa âm nhạc ra cuộc sống</h2>
            <p>Âm nhạc là yếu tố giúp bạn giảm stress sau những ngày làm việc và học tập mệt mỏi. Để tận hưởng trọn vẹn giai điệu của bản nhạc bạn cần có một chiếc <a href="https://cellphones.com.vn/thiet-bi-am-thanh/loa/lg.html" target="_blank">loa LG</a> có những tính năng hiện đại vừa phù hợp khi sử dụng ở nhà vừa phù hợp lúc đi dã ngoại cùng với gia đình và bạn bè.&nbsp;<strong>Loa bluetooth LG XBoom Go PL7&nbsp;</strong>là một chiếc loa có diện mạo mới rất bắt mắt, giúp bạn tận hưởng một bản nhạc một cách tuyệt vời nhất có thể.</p>
            <h3>Thiết kế nhỏ gọn chất liệu cao cấp,&nbsp;trang bị đèn led sống động</h3>
            <p>LG XBoom Go PL7 được hãng thiết kế dáng tròn dài rất nhỏ gọn, tổng trọng lượng loa siêu nhẹ lên đến 1,86kg. Giúp người dùng có thể mang loa đi bất cứ nơi đâu một cách dễ dàng. Hơn thế, LG PL7 được phủ bên ngoài là lớp cao su cao cấp, người dùng dễ dàng cầm nắm mà không sợ bị trượt tay làm rơi rớt loa. Với chất liệu được phủ bên ngoài sẽ giúp cho loa hạn chế bám bẩn mồ hôi và vân tay và luôn làm sạch sẽ và bóng loáng cho chiếc loa.</p>
            <p><img class="cpslazy loaded" alt="Thiết kế nhỏ gọn chất liệu cao cấp" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7.jpg"></p>
            <p>Hãng LG đã trang&nbsp;bị đèn led nhiều màu cho chiếc&nbsp;loa LG XBoom PL7 tạo nên sự sống động. Hơn thế đèn led có thể thay đổi theo giai điệu bài hát, tạo nên vẻ ngoài bắt mắt và sôi động. Bạn có thể điều chỉnh màu sắc, tốc độ của đèn led thông qua ứng dụng XBoom.&nbsp;Chiếc&nbsp;loa bluetooth XBoom Go PL7 giúp người dùng tận hưởng giai điệu cả về thị giác và thính giác.</p>
            <p><img class="cpslazy loaded" alt="trang bị đèn led sống động" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-1.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-1.jpg"></p>
            <h3>Tích hợp công nghệ&nbsp;Meridian&nbsp;và Sound Boost, công suất phát 30W</h3>
            <p><strong>Loa LG XBoom Go PL7</strong> được&nbsp;tích hợp công nghệ Meridian tạo ra chất lượng âm thanh rất tuyệt vời. Khi bạn sở hữu chiếc loa&nbsp;LG&nbsp;này mỗi khi nghe nhạc là mỗi lần thưởng thức những âm sắc phong phú và những âm bass trầm bổng và chính xác đến từng nốt nhạc. Hơn thế, chiếc&nbsp;<a href="https://cellphones.com.vn/thiet-bi-am-thanh/loa/loa-bluetooth.html" target="_blank">loa bluetooth</a> LG XBoom Go PL7 tích hợp&nbsp;Sound Boost giúp loa khuếch đại và mở rộng các dải âm thanh. Bạn chỉ cần nhấn nút Sound Boost là có thể mở tính năng này và khuấy động được không gian thư giãn.</p>
            <p><img class="cpslazy loaded" alt="Tích hợp công nghệ Meridian và Sound Boost" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-2.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-2.jpg"></p>
            <p>Ngoài ra với công suất phát 30W màng loa có thể rung theo giai điệu của bài hát mà bạn đang mở trên loa tạo sự sôi động và lôi cuốn mọi người hòa mình vào âm nhạc như cách mà loa rung chuyển động theo nhịp điệu. Kết hợp với độ rung màn loa là đèn led được sáng nhấp nháy và chạy theo dạng vòng tròn chuyển động rực rỡ tạo nên không gian sống động với nhiều màu sắc nổi bật.</p>
            <p><img class="cpslazy loaded" alt="công suất phát 30W" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-3.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-3.jpg"></p>
            <h3>Dung lượng pin cao 3900 mAh sử dụng xuyên suốt đến 24 tiếng, khả năng chống nước IPX5</h3>
            <p>Bạn là người yêu thích âm nhạc mà thường xuyên có những chuyến dã ngoại để giảm stress cùng với gia đình hay bạn bè. Những khoảnh khắc nghỉ ngơi này, yếu tố không thể thiếu với bạn là một chiếc loa để bạn cùng mọi người tận hưởng những giai điệu của bản nhạc. Nhưng điều bạn lo lắng rằng pin của chiếc loa sẽ không đủ để bạn sử dụng. Đừng lo, chiếc <strong>LG PL7</strong> được hãng thiết kế dung lượng pin lên đến 3900 mAh, giúp bạn có thể sử dụng loa liên tục trong vòng 24h mà không sợ bị hết pin, không bị ngắt quãng cuộc vui của bạn.</p>
            <p><img class="cpslazy loaded" alt="Dung lượng pin cao 3900 mAh" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-4.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-4.jpg"></p>
            <p>Bạn có những buổi tiệc dã ngoại ngoài trời, nơi có độ ẩm cao đặc biệt là nước. <strong>LG XBoom PL7</strong> được trang bị IPX5 khả năng chống bụi, chống nước và bụi bẩn len lỏi vào bên trong khi sử dụng. Giúp người dùng thoải mái sử dụng loa trong bất kỳ môi trường như thế nào cũng không bị ảnh hưởng xấu đến chiếc loa.</p>
            <p><img class="cpslazy loaded" alt="khả năng chống nước IPX5" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-5.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-5.jpg"></p>
            <h3>Bluetooth 5.0 tương thích với nhiều thiết bị, điều khiển dễ dàng</h3>
            <p>Với công nghệ bluetooth 5.0,&nbsp;loa LG PL7 sẽ tương thích hầu hết tất cả các thiết bị di động phổ biến hiện nay như điện thoại, máy tính bảng, tivi, laptop,... Bạn có thể kết nối loa với các thiết bị di động cá nhân của mình ở bất kỳ nơi đâu hay bất cứ lúc nào mà không bị giới hạn khả năng kết nối.</p>
            <p><img class="cpslazy loaded" alt="Bluetooth 5.0 tương thích với nhiều thiết bị" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-6.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-6.jpg"></p>
            <p><strong>Loa LG XBoom Go PL7</strong> được hãng thiết kế các nút bấm rất nhạy, giúp người dùng có thể dễ dàng thực hiện các thao tác điều chỉnh phù hợp với không gian thư giãn của bạn. Hơn thế, ngoài tính năng điều khiển bằng nút bấm loa bluetooth LG PL7 cùng có tính năng điều khiển bằng giọng nói. Để kích hoạt tính năng này bạn chỉ cần bấm giữ nút phát nhạc trong vòng 2 giây, màn hình điện thoại sẽ hiện lên tính năng Google Assistant trên điện thoại có hệ điều hành Android hoặc Siri trên có hệ điều hành iOS. Bạn có thể điều khiển bật hay tắt nhạc và các chức năng khác mà chỉ cần dùng lệnh bằng giọng nói.</p>
            <p><img class="cpslazy loaded" alt="điều khiển dễ dàng" data-src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-7.jpg" data-ll-status="loaded" src="https://cdn.cellphones.com.vn/media/wysiwyg/accessories/loa/Loa-Bluetooth-LG-XBoom-PL7-7.jpg"></p>
            <h2>Mua&nbsp;loa bluetooth LG XBoom PL7 giá rẻ, chất lượng tại CellphoneS</h2>
            <p>Với những tính năng hiện đại mà loa LG XBoom PL7 sở hữu như khả năng chống nước IPX5, nhiều công nghệ âm thanh hiện đại phổ biến nhất hiện nay. Bạn còn chần chừ nữa mà không sở hữu ngay cho mình một chiếc loa LG. Đến ngay Cellphones để mua cho mình <strong>LG XBoom PL7&nbsp; Go chính hãng</strong>, giá rẻ cùng với chính sách bảo hành 12 tháng của hãng. Bên cạnh đó, bạn cũng có thể tham khảo thêm <a href="https://cellphones.com.vn/loa-bluetooth-lg-xboom-go-pl2.html" target="_blank">loa LG XBoom Go PL2</a> đang có giá tốt tại Cellphones.</p>
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
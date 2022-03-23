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
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                style="cursor: pointer; width: 50px; height: 30px; min-width: 50px; min-height: 30px; background-image: url('{{ asset($image->image) }}');
                                                                                            background-size: cover; background-position: center; margin-bottom: 5px;"
                                class="@if ($key == 0) active @endif">
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
            <p class="mt-4 mb-2">Danh mục: <a
                    href="{{ isset($product->category->category)? route('site.category.parent', [$product->category->category->slug, $product->category->slug]): route('site.category', $product->category->slug) }}">{{ $product->category->name ?? '' }}</a>
            </p>
        @endif

        @isset($product->trademark->name)
            <p class="mt-0 mb-2">Thương hiệu: <a
                    href="{{ route('site.trademark', $product->trademark->slug) }}">{{ $product->trademark->name ?? '' }}</a>
            </p>
            @endif
        </template>
        </product>
        <div class="div mt-3"></div>
        <div class="p-3 tmp">
            {{-- {!!$product->description!!} --}}
            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab"
                id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="">

                <h2>Mô tả</h2>

                <p style="text-align: justify;">Miếng dán màn hình Macbook 14inch, 16inch cao cấp, từ tính, với độ trong suốt
                    cao, không làm giảm độ phân giải màn hình khi dán vào. Sau một thời gian dài sử dụng, miếng dán không bị ố
                    vàng, dễ dàng gỡ ra thay thế.</p>
                <p><img loading="lazy" class="size-full wp-image-17363 aligncenter"
                        src="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2021-chip-m1-mocol-maccare-02.jpg"
                        alt="dán màn hình macbok 14inch, 16inch chính hãng mocoll" width="1024" height="683"
                        srcset="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2021-chip-m1-mocol-maccare-02.jpg 1024w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2021-chip-m1-mocol-maccare-02-768x512.jpg 768w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2021-chip-m1-mocol-maccare-02-850x567.jpg 850w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2021-chip-m1-mocol-maccare-02-120x80.jpg 120w"
                        sizes="(max-width: 1024px) 100vw, 1024px"></p>
                <p style="text-align: justify;">Macbook pro 14inch, 16inch được Apple trang bị màn hình Liquid Retina XDR, màn
                    hình hiển thị tốt nhất từ trước đến nay trên máy tính xách tay. Việc người dùng cần làm ngay sau khi mua máy
                    tính chắc chắn sẽ là việc bảo vệ màn hình tránh khỏi trầy xước, bụi bẩn, chất ăn mòn trong suốt quá trình sử
                    dụng.</p>
                <p><img loading="lazy" class="size-full wp-image-17364 aligncenter"
                        src="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2020-mocoll-maccare-vn.jpg"
                        alt="miếng dán màn hình macbok 14inch, 16inch chính hãng mocoll" width="1024" height="683"
                        srcset="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2020-mocoll-maccare-vn.jpg 1024w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2020-mocoll-maccare-vn-768x512.jpg 768w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2020-mocoll-maccare-vn-850x567.jpg 850w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-16inch-2020-mocoll-maccare-vn-120x80.jpg 120w"
                        sizes="(max-width: 1024px) 100vw, 1024px"></p>
                <p style="text-align: justify;">Dán bảo vệ màn hình macbook 14inch, 16inch cũng cần miếng dán màn hình “xịn sò”
                    đến từ những thương hiệu nổi tiếng, không chỉ bảo vệ màn hình mà còn giúp việc dán vào, gỡ ra dễ dàng hơn,
                    không làm ảnh hưởng tới màn hình.</p>
                <h2><span style="font-size: 12pt;"><strong>Dán màn hình Macbook 14inch, 16inch M1 2021 chính hãng
                            Mocoll&nbsp;</strong></span></h2>
                <p style="text-align: justify;">Miếng <a href="https://maccare.vn/phu-kien/dan-macbook/">dán màn hình macbook
                        pro 14inch, 16inch</a> thương hiệu Mocoll đang được nhiều người tìm kiếm và sử dụng trong vài năm trở
                    lại đây bởi chất lượng cao, đường cắt chính xác cùng công nghệ từ tính không để lại keo khi gỡ ra.</p>
                <p><img loading="lazy" class="size-full wp-image-17369 aligncenter"
                        src="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0001.jpg"
                        alt="dán màn hình macbook 14inch mocoll" width="1024" height="683"
                        srcset="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0001.jpg 1024w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0001-768x512.jpg 768w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0001-850x567.jpg 850w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0001-120x80.jpg 120w"
                        sizes="(max-width: 1024px) 100vw, 1024px"></p>
                <p style="text-align: justify;">Trong suốt thời gian sử dụng, nếu không dán màn hình và không vệ sinh thường
                    xuyên, màn hình của Macbook sẽ có dấu bàn phím in hằn lên màn hình, gây mất thẩm mỹ và trầy xước, không thể
                    lau chùi được.</p>
                <p style="text-align: justify;">Dán màn hình Macbook pro 14inch, 16inch Mocoll có độ trong suốt cao, không làm
                    giảm đi độ phân giải, trải nghiệm sử dụng khi dán vào. Miếng dán được cắt chính xác, có độ thẩm mỹ cao. Với
                    miếng dán này, nếu không để ý kỹ sẽ không phát hiện ra màn hình đã dán hay chưa, tạo cảm giác dán như không
                    dán vậy.</p>
                <p><img loading="lazy" class="size-full wp-image-17370 aligncenter"
                        src="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0003.jpg"
                        alt="dán màn hình macbook 14inch mocoll" width="1024" height="683"
                        srcset="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0003.jpg 1024w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0003-768x512.jpg 768w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0003-850x567.jpg 850w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-0003-120x80.jpg 120w"
                        sizes="(max-width: 1024px) 100vw, 1024px"></p>
                <p style="text-align: justify;">Công nghệ từ tính trên miếng dán màn hình Macbook 14inch, 16inch giúp bám dính
                    vào màn hình khi dán nhưng không làm ảnh hưởng tới màn hình khi tháo gỡ ra. Miếng dán màn hình không sử dụng
                    keo để dính nên không để lại vết keo khi gỡ ra. Khách hàng có thể hoàn toàn yên tâm thay thế miếng dán màn
                    hình bất cứ lúc nào.</p>
                <p><img loading="lazy" class="size-full wp-image-17372 aligncenter"
                        src="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-005.jpg"
                        alt="dán màn hình macbook 14inch mocoll" width="1024" height="683"
                        srcset="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-005.jpg 1024w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-005-768x512.jpg 768w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-005-850x567.jpg 850w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-005-120x80.jpg 120w"
                        sizes="(max-width: 1024px) 100vw, 1024px"></p>
                <p style="text-align: justify;">Bộ vệ sinh đi kèm với miếng dán màn hình Macbook, các miếng sticker Mocoll được
                    làm chăm chút và phù hợp để lấy bụi, làm sạch trước lúc dán. Kích thước sticker lớn hơn các hãng khác, giúp
                    chúng ta lấy bụi, vệ sinh nhanh và sạch hơn bao giờ hết.</p>
                <p><img loading="lazy" class="size-full wp-image-17371 aligncenter"
                        src="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-004.jpg"
                        alt="dán màn hình macbook 14inch mocoll" width="1024" height="683"
                        srcset="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-004.jpg 1024w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-004-768x512.jpg 768w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-004-850x567.jpg 850w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-004-120x80.jpg 120w"
                        sizes="(max-width: 1024px) 100vw, 1024px"></p>
                <p style="text-align: justify;">Để dán miếng dán lên màn hình Macbook, chúng ta bóc miếng số 1 trước, mặt này có
                    từ tính sẽ bám dính vào màn hình.</p>
                <p><img loading="lazy" class="size-full wp-image-17373 aligncenter"
                        src="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-003.jpg"
                        alt="dán màn hình macbook 14inch, 16inch m1 mocoll" width="1024" height="683"
                        srcset="https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-003.jpg 1024w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-003-768x512.jpg 768w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-003-850x567.jpg 850w, https://maccare.vn/wp-content/uploads/2022/03/dan-man-hinh-macbook-14inch-2021-mocoll-maccare-vn-003-120x80.jpg 120w"
                        sizes="(max-width: 1024px) 100vw, 1024px"></p>
                <p style="text-align: center;">Sau khi dán xong chúng ta bóc miếng số 2 này ra</p>
                <h3><span style="font-size: 12pt;"><strong>Miếng dán màn hình Macbook Pro 14inch, 16inch 2021 chip M1 tại
                            MacCare.vn</strong></span></h3>
                <p style="text-align: justify;">Miếng dán màn hình cho Macbook pro 14inch, 16inch được <a
                        href="https://maccare.vn/">maccare.vn</a> nhập khẩu trực tiếp từ hãng Mocoll, miếng dán còn nguyên seal
                    từ khi hàng về tới tay khách hàng.</p>
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

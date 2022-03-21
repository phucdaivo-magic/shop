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
        <template  v-slot:about>
            <h1 style="font-size: 20px">{{ $product->name }}</h1>
            <h3 class="text-danger">{{ number_format($product->price) }} VND</h3>

        </template>
        <template  v-slot:bottom>
            @if($product->category)
            <p class="mt-4 mb-2">Danh mục: <a href="{{ isset($product->category->category) ? route('site.category.parent', [$product->category->category->slug, $product->category->slug]) : route('site.category', $product->category->slug) }}">{{ $product->category->name ?? '' }}</a></p>
            @endif

            @isset($product->trademark->name)
                <p class="mt-0 mb-2">Thương hiệu: <a href="{{ route('site.trademark', $product->trademark->slug) }}">{{ $product->trademark->name ?? '' }}</a></p>
            @endif
        </template>
    </product>
    <div class="div mt-3"></div>
    <div class="py-3">
        {!!$product->description!!}
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

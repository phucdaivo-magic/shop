@extends('layouts.site')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Sản phẩm đã thích</h1>
    <product-favorite next="{{ route('site.favorite.product') }}">
    </product-favorite>
</div>
@endsection
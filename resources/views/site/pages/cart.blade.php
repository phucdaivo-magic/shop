@extends('layouts.site')

@section('content')
<div class="container mt-4">
    <h1>Giỏ hàng</h1>
    <cart>
        <div slot-scope="slotProps">
            <a href="{{ route('site.index') }}" class="btn btn-primary font-weight-bold mr-2 text-white rounded-0">Tiếp tục mua hàng</a>
            <a v-if="slotProps.mount" href="{{ route('site.payment') }}" class="btn btn-danger font-weight-bold text-white rounded-0">
                Tiến Hành thanh toán</a>
        </div>
    </cart>
</div>
@endsection
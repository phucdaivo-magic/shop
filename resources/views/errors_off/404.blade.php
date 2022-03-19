@extends('layouts.user')

@section('content')
<div style="height: 40vh">
  <div class="page-err container text-center mt-5">
    <h2 class="text-danger font-weight-bold">RẤT TIẾC! KHÔNG THỂ TÌM THẤY TRANG NÀY</h2>
    <p>Không tìm thấy nội dung yêu cầu. Bạn có thể thử tìm kiếm phía dưới hoặc về trang chủ</p>
    <div>
      <a href="{{ route('user.home') }}" class="btn btn-primary" style="background: #f58220; border-color: #f58220">Trở về trang chủ</a>
    </div>
  </div>
</div>
@endsection

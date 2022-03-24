@extends('layouts.site')

@section('content')
<div class="pane-header">
    <h1>Liên hệ</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row pt-5 pb-4">
                <div class="col-md-6">
                    <h3>Shop.vn – Care for your Mac</h3>
                    <p>Shop được thành lập vào năm 2006. Chuyên sản xuất các thiết bị ngoại vi áp dụng khoa học công nghệ và công thái học giúp di trì khả năng làm việc lâu dài hiệu quả.

                        Giá treo màn hình máy tính F80 mẫu 2021 được cấu tạo bằng hợp kim nhôm, bền đẹp, an toàn cho người sử dụng, thân thiện với môi trường. Là sản phẩm được đánh giá tốt nhất trong năm.

                        Sản phẩm Phù hợp với hầu hết các màn hình 17 "- 30"
                        Tải trọng hỗ trợ từ 4,4 đến 19,8 lbs (2-9 kg)
                        Tuân thủ VESA 75x75, 100x100 mm
                        Khoảng cách nâng lên hạ xuống 10 ”(260mm)</p>
                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.212841519796!2d106.71968101458012!3d10.795004161802892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529a1602a74c1%3A0x42fd34e413987eae!2sLandmark%205%20Vinhomes%20Central%20Park!5e0!3m2!1svi!2s!4v1648094341897!5m2!1svi!2s" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <p>Bạn có thể điền thông tin liên hệ vào form dưới đây Shop sẽ liên hệ ngay với bạn khi nhận được thông tin.</p>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên</label>
                        <input type="text" class="form-control rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Họ và tên">
                        <small hidden id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ email</label>
                        <input type="email" class="form-control rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Địa chỉ email">
                        <small hidden id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input type="email" class="form-control rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Số điện thoại">
                        <small hidden id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung liên hệ</label>
                        <textarea class="form-control rounded-0" name="" id="" cols="30" rows="6" placeholder="Nội dung liên hệ"></textarea>
                        <small hidden id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <button class="btn btn-danger mb-3 pl-4 pr-4 rounded-0">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
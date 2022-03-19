@csrf
<div class="form-row">
    <div class="form-group col-md-6">
        <input required name="name" type="text" class="form-control form-control-lg" placeholder="Họ và tên(*)">
    </div>
    <div class="form-group col-md-6">
        <input name="email"  type="email" class="form-control form-control-lg" placeholder="Email">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <input name="title" type="text" class="form-control form-control-lg" placeholder="Tiêu đề">
    </div>
    <div class="form-group col-md-6">
        <input required name="phone" type="phone" class="form-control form-control-lg" placeholder="Số điện thoại(*)">
    </div>
</div>
<div class="form-group position-relative">
    <textarea required name="content" placeholder="Nội dung(*)" class="form-control form-control-lg" rows="3"></textarea>
</div>

@php
    use App\Services\User\SettingService;
    $setting = new SettingService();
    $footerSetting = $setting->getFooterSetting();
@endphp
<div class="footer @if($footerSetting->baner) footer-image @endif" @if($footerSetting->baner)
        style="background-image: url('{{ asset($footerSetting->baner ?? '') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;" @endif>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12">
                <div class="title">{{ $footerSetting->title ?? '' }}</div>
                <div>
                    {!! $footerSetting->content ?? '' !!}
                </div>
            </div>

            <div class="col-lg-5 col-12 mb-3">
                <div class="title">ĐĂNG KÝ NHẬN TƯ VẤN BDS</div>
                <form action="{{ route('user.contact') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group w-100 mb-2">
                            <input hidden name="title" type="text" value="[ĐĂNG KÝ NHẬN TƯ VẤN BDS]">
                            <input required name="name" type="text" class="form-control form-control-sm mb-2" placeholder="Tên (*)">
                            <input required name="phone" type="text" class="form-control form-control-sm mb-2" placeholder="Số điện thoại">
                            <input required name="email" type="text" class="form-control form-control-sm" placeholder="Email">
                        </div>
                        <button class="btn btn-primary  btn-sm px-4">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-bar">

    </div>
</div>

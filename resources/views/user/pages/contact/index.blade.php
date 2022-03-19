@php
    use App\Services\User\SettingService;
    $setting = new SettingService();
    $footerSetting = $setting->getFooterSetting();
@endphp
@extends('layouts.user')

@section('breadcrumb')
    @include('user.components.breadcrumb', [
    'breadcrumbs' => [
    [
    'name' => 'Liên hệ'
    ]
    ]
    ])
@endsection

@section('content')
    <div class="contact mb-5">
        <div class="cs-title text-center position-relative mt-5">
            Liên hệ
        </div>
        <div class="container">
            <p>Quý khách vui lòng điền thông tin vào mẫu bên dưới và gửi những góp ý, thắc mắc cho Kim Oanh Group, chúng tôi
                sẽ phản hồi email của Quý khách trong thời gian sớm nhất.</p>
            <form action="{{ route('user.contact') }}" method="POST">
                @include('user.components.form_contact')
                <button class="cs-button btn btn-primary position-relative px-5">Gửi</button>
            </form>
        </div>

        <div class="container mt-3">
            @if ($footerSetting)
                {!! $footerSetting->map !!}
            @endif
        </div>

    </div>
@endsection

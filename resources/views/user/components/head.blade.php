<title>{{ (isset($meta['title']) ? $meta['title'] . ' - ' : '') . (isset($headerSetting) && isset($headerSetting->meta_title) ? $headerSetting->meta_title : '') }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <meta property="fb:app_id" content="2034212100232051" /> --}}
{{-- <meta property="og:site_name" content="diaockimoanhdn.com" />
<meta property="og:type" content="article" />
<meta property="og:image" content="https://znews-photo-fbcrawler.zadn.vn/w1250/Uploaded/jaegtn/2022_02_09/ukraine_4.jpg" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" /> --}}

{{-- <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "headline": "Analyzing Google Search traffic drops",
        "datePublished": "2021-07-20T08:00:00+08:00",
        "dateModified": "2021-07-20T09:20:00+08:00"
    }
</script> --}}

<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap&subset=vietnamese" rel="stylesheet">
@if (isset($headerSetting) && isset($headerSetting->icon))
<link rel="shortcut icon" href="{{ url($headerSetting->icon) }}">
@endif

<!-- This site is optimized with the Yoast SEO plugin v11.6 - https://yoast.com/wordpress/plugins/seo/ -->
<meta name="description" content="{{ isset($meta['description']) ? $meta['description'] : '' }}" />
<meta name="keywords" content="{{ isset($meta['keywords']) ? $meta['keywords'] : '' }}"/>
<link rel="canonical" href="{{ URL::current() }}" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ (isset($meta['title']) ? $meta['title'] . ' - ' : '') . (isset($headerSetting) && isset($headerSetting->meta_title) ? $headerSetting->meta_title : '') }}" />
<meta property="og:description" content="{{ isset($meta['description']) ? $meta['description'] : '' }}">

<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:site_name" content="Địa Ốc Kim Oanh" />
{{-- <meta property="article:publisher" content="https://www.facebook.com/SaidVietnam.official/" /> --}}
<meta property="og:image" content="{{ isset($meta['image']) ? asset($meta['image']) : ( isset($headerSetting) && isset($headerSetting->baner) ? asset($headerSetting->baner) : '') }}" />
<meta property="og:image:secure_url" content="{{ isset($meta['image']) ? asset($meta['image']) : ( isset($headerSetting) && isset($headerSetting->baner) ? asset($headerSetting->baner) : '') }}"/>
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta name="twitter:card" content="summary_large_image" />

<meta name="twitter:description" content="{{ isset($meta['description']) ? $meta['description'] : '' }}"  />
<meta name="twitter:title" content="{{ (isset($meta['title']) ? $meta['title'] . ' - ' : '') . (isset($headerSetting) && isset($headerSetting->meta_title) ? $headerSetting->meta_title : '') }}" />
<meta name="twitter:image" content="{{ isset($meta['image']) ? asset($meta['image']) : ( isset($headerSetting) && isset($headerSetting->baner) ? asset($headerSetting->baner) : '') }}"/>
<!-- / Yoast SEO plugin. -->

{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
{{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
<link href="{{ asset('site_user/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('site_admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('site_user/css/user.css') }}" rel="stylesheet">
<link href="{{ asset('site_user/fancybox/fancybox.css') }}" rel="stylesheet"/>
<link href="{{ asset('site_user/animation/animate.min.css') }}" rel="stylesheet"/>

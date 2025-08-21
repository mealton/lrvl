<base href="https://news.mealton.ru">
<!-- Title -->
<title>{!! html_entity_decode(@$title) ?: "Mealton!!!" !!}</title>
<!-- Meta Tags -->
<meta charset="utf-8">
{{--<meta name="author" content="<?= $author ?>">--}}
{{--<meta name="keywords" content="<?= $keywords ?>">--}}
<meta name="description" content="{{ @$description ?? "Какое-то описание" }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="robots" content="index, follow">
<meta name="vk:image" content="{{ @$image ?? "" }}"/>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset("/assets/img/favicon.webp")  }} " type="image/webp">
<!-- Google Fonts -->
<link rel="stylesheet" href="{{ asset("/assets/css/fonts.css")  }} ">
<!-- Plugins CSS -->
<link rel="stylesheet" href="{{ asset("/assets/css/plugins.css")  }} ">
<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset("/assets/css/style.css")  }} ">
<!-- Fancybox CSS -->
<link rel="stylesheet" href="{{ asset("/vendors/fancybox/jquery.fancybox.min.css")  }} ">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset("/assets/css/custom.min.css?v=354354354345")  }} ">
<!-- Canonical -->
<link rel="canonical" href="{{ url()->current()  }} "/>

<!-- jquery -->
<script src="{{ asset("/vendors/jquery/jquery.min.js")  }} "></script>
<script src="{{ asset("/vendors/jquery/jquery.mousewheel.min.js")  }} "></script>

<script src="{{ asset("/assets/js/lib.js?t=354354354354")  }} "></script>
<script src="{{ asset("/assets/js/index.js?t=567567567567")  }} "></script>

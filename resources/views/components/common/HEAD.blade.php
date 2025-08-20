<?php
/**
 * @var $title string
 * @var $author string
 * @var $keywords string
 * @var $description string
 * @var $image string
 * @var $image_meta array
 * @var $published_time string
 * @var $is_image boolean
 * @var $category string
 * @var $meta_hashtags string
 */

?>
<!-- Title -->
<title><?= $title ?></title>
<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="author" content="<?= $author ?>">
<meta name="keywords" content="<?= $keywords ?>">
<meta name="description" content="<?= htmlspecialchars($description) ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="robots" content="index, follow">
<meta name="vk:image" content="<?= $image ?>"/>
<meta name="yandex-verification" content="b4c09c68dca28575"/>

<!--Open Graph-->
<meta property="og:site_name" content="Mealton | Фотографии">
<meta property="og:title" content="<?= htmlspecialchars($title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($description) ?>">
<meta property="og:url" content="<?= get_current_url() ?>">
<meta property="og:locale" content="ru_RU"/>
<meta property="og:type" content="<?= @$is_image ? "article" : "website" ?>">
<meta property="og:image" content="<?= $image ?>">
<meta property="og:image:width" content="<?= @$image_meta['width'] ?>">
<meta property="og:image:height" content="<?= @$image_meta['height'] ?>"
<meta property="og:image:type" content="<?= @$image_meta['mime'] ?>"/>
<meta property="og:logo" content="/assets/img/favicon.webp"/>
<?php if (@$is_image): ?>
    <meta property="og:article:published_time" content="<?= @$published_time ?>">
    <meta property="og:article:author" content="<?= $author ?>">
    <meta property="og:article:section" content="<?= @$category ?>">
    <?= @$meta_hashtags ?>
<?php endif ?>
<!--Open Graph-->

<!--Twitter-->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="Mealton | Фотографии"/>
<meta name="twitter:title" content="<?= htmlspecialchars($title) ?>"/>
<meta name="twitter:description" content="<?= htmlspecialchars($description) ?>"/>
<meta name="twitter:image" content="<?= $image ?>"/>
<meta name="twitter:url" content="<?= get_current_url() ?>"/>
<!--Twitter-->

<!--GEO-->
<meta name="geo.placename" content="Московская область, Россия">
<meta name="geo.region" content="RU-MOW"> <!-- RU - Россия, MOW - Московская область -->
<meta name="geo.latitude" content="55.7558"> <!-- Пример широты для Москвы -->
<meta name="geo.longitude" content="37.6173"> <!-- Пример долготы для Москвы -->
<meta name="ICBM" content="55.7558, 37.6173">
<!--GEO-->

<!-- Favicon -->
<link rel="shortcut icon" href="/assets/img/favicon.webp" type="image/webp">
<!-- Google Fonts -->
<link rel="stylesheet" href="/assets/css/fonts.css">
<!-- Plugins CSS -->
<link rel="stylesheet" href="/assets/css/plugins.css">
<!-- Main CSS -->
<link rel="stylesheet" href="/assets/css/style.css">
<!-- Fancybox CSS -->
<link rel="stylesheet" href="/vendors/fancybox/jquery.fancybox.min.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="/assets/css/custom.min.css?v=<?= time() ?>">
<!-- Canonical -->
<link rel="canonical" href="<?= get_current_url() ?>"/>


<!-- jquery -->
<script src="/vendors/jquery/jquery.min.js"></script>
<script src="/vendors/jquery/jquery.mousewheel.min.js"></script>

<script>const FILTER = "<?= htmlspecialchars($_SESSION['filter']) ?>";</script>

<script src="/assets/js/lib.js?t=<?= time() ?>"></script>
<script src="/assets/js/index.js?t=<?= time() ?>"></script>

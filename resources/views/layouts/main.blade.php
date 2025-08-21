<html lang="ru">
<head>
    @include("components.common.HEAD")
</head>
<body>
<main>
    <!-- Start Page Preloader -->
    <div id="loading" style="display: none;">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>
    <!-- End Page Preloader -->
    <!-- Start Header -->
    <header>
        @include("components.common.TOP-HEADER")
        @include("components.common.HEADER")
        <hr class="g-mx-0 g-my-0">
    </header>
    <!-- End Header -->

    @include("components.common.breadcrumbs")

    <main id="main-content">
        <div class="container g-pt-45 g-pb-45">
            <div class="row justify-content-center">
                <div class="col-lg-9 g-mb-30">
                    @yield("content")
                </div>
                <!-- Start Blog Sidebar -->
                @include("components.sidebar.sidebar")
                <!-- End Blog Sidebar -->
            </div>
        </div>
    </main>

    <footer>
        @include("components.common.FOOTER")
    </footer>

</main>

@include("components.common.SCRIPTS")

</body>
</html>

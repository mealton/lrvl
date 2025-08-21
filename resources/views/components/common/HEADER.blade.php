<header id="js-header" class="u-header u-header--static dark-header">
    <div class="u-header__section u-header__section--dark g-bg-primary g-transition-0_3 g-py-10">
        <nav class="js-mega-menu navbar navbar-expand-lg hs-menu-initialized hs-menu-horizontal gs-main-nav">
            <div class="container">
                <!-- Start Responsive Toggle Button -->
                <button
                    class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0"
                    type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar"
                    data-toggle="collapse" data-target="#navBar">
                        <span class="hamburger hamburger--slider g-pt-5 g-pr-0">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </span>
                </button>
                <!-- End Responsive Toggle Button -->
                <!-- Start Logo -->
                <a href="{{ route("post.index")  }}" class="navbar-brand">
                    <img src="{{ asset("assets/img/logo.svg")  }}" alt="Gravity" width="50">
                </a>
                <!-- End Logo -->
                <!-- Start Navigation -->
                <div class="collapse navbar-collapse align-items-center flex-sm-row" id="navBar">
                    <ul class="navbar-nav text-uppercase gs-main-nav-list g-font-weight-600 ml-auto">
                        <li class="nav-item hs-has-sub-menu g-mx-15--lg" data-animation-in="fadeIn"
                            data-animation-out="fadeOut">
                            <a id="nav-link--home" class="nav-link g-py-7 g-px-0" href="{{ route("post.all")  }}"
                               aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu--home">
                                Все посты
                            </a>
                        </li>
                        <li class="nav-item hs-has-sub-menu g-mx-15--lg" data-animation-in="fadeIn"
                            data-animation-out="fadeOut">
                            <a id="nav-link--landing" class="nav-link g-py-7 g-px-0" href="{{route("post.categories")}}"
                               aria-haspopup="true" aria-expanded="false"
                               aria-controls="nav-submenu--landing">Категории</a>
                            <ul class="hs-sub-menu list-unstyled u-shadow-v11 g-brd-top g-brd-primary g-brd-top-2 g-min-width-220 g-mt-18 g-mt-8--lg--scrolling animated fadeOut"
                                id="nav-submenu--home--landings" aria-labelledby="nav-link--home--landings"
                                style="display: none;">

                                @foreach(App\Services\Main\Service::get_header_categories() as $item)
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{route("post.index") . "?category=" . $item->id}}">
                                            {{$item->name}}
                                        </a>
                                    </li>
                                @endforeach
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                    <a class="nav-link" href="{{route("post.categories")}}">
                                        Все категории
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item hs-has-sub-menu g-mx-15--lg" data-animation-in="fadeIn"
                            data-animation-out="fadeOut">
                            <a id="nav-link--pages" class="nav-link g-py-7 g-px-0" href="{{route("post.authors")}}"
                               aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu--pages">Авторы</a>
                        </li>
                        <li class="nav-item hs-has-sub-menu g-mx-15--lg" data-animation-in="fadeIn"
                            data-animation-out="fadeOut">
                            <a id="nav-link--blog" class="nav-link g-py-7 g-px-0"  aria-haspopup="true"
                               aria-expanded="false" aria-controls="nav-submenu--blog">Вход</a>
                            <ul class="hs-sub-menu list-unstyled u-shadow-v11 g-brd-top g-brd-primary g-brd-top-2 g-min-width-220 g-mt-18 g-mt-8--lg--scrolling animated fadeOut"
                                id="nav-submenu--blog" aria-labelledby="nav-link--blog" style="display: none;">
                                <li class="dropdown-item">
                                    <a class="nav-link" >Авторизация</a>
                                </li>
                                <li class="dropdown-item">
                                    <a class="nav-link" >Регистрация</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- End Navigation -->
            </div>
        </nav>
    </div>
</header>

<header id="js-header" class="u-header u-header--static dark-header">
    <div class="mechanika-top-header u-header__section u-header__section--hidden u-header__section--dark g-bg-black g-transition-0_3 g-py-10 top-bar">
        <div class="container">
            <div class="row flex-sm-row justify-content-between align-items-center g-font-weight-600 g-color-white g-font-size-12 g-mx-0--lg top-header__container">
                <!-- Start Social Icons -->

                <div class="col-auto g-pos-rel g-px-15 location-switcher">
                    <a title="На главную" href="/" class="g-color-white g-color-gray-light-v1--hover g-mr-10">
                        <i class='fa fa-picture-o g-font-size-16 g-valign-middle'
                           aria-hidden='true'></i>
                    </a>
                    <i class="icon-location-pin g-font-size-16 g-valign-middle g-color-white g-mr-5"></i>
                    <span><?= location() ?></span>
                </div>


                <!-- End Social Icons -->

                <!-- Start Languages -->
                <div class="col-auto g-pos-rel g-hidden-md-down">

                <span style="text-transform: none;">
                    <span class="datetime-string"><?= date_info() ?></span>
                </span>
                </div>
                <!-- End Languages -->
                <!-- Start Search -->

                <div class="col-auto">

                    <?php if (isset($_COOKIE['AUTH']) && $_COOKIE['AUTH'] == "1"): ?>
                        <div class="d-inline-block g-valign-middle g-pos-rel g-top-minus-1 mr-2 d-xs-none">
                            <?php if (isset($_COOKIE['EDITOR'])): ?>
                                <li class="list-inline-item d-flex align-items-center justify-content-center mr-0">
                                    <a href="/quite/"
                                       title="Выйти из режима редактирования"
                                       class="g-font-size-18 g-color-white g-color-gray-light-v1--hover">
                                        <i class='fa fa-pencil-square' aria-hidden='true'></i>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="list-inline-item d-flex align-items-center justify-content-center mr-0">
                                    <a href="/editor/"
                                       title="Войти в режим редактирования"
                                       class="g-font-size-18 g-color-white g-color-gray-light-v1--hover">
                                        <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="d-inline-block g-valign-middle g-pos-rel g-top-minus-1 mr-2 pointer">
                        <?php if (isset($_COOKIE['AUTH']) && $_COOKIE['AUTH'] == "1"): ?>
                            <span onclick="confirm('Точно выйти?') ? location.href=this.dataset.href : false"
                                  data-href="/logout"
                                  class="g-font-size-18 g-color-white g-color-gray-light-v1--hover">
                                <i class="fa fa-sign-out" aria-hidden="true" title="Выйти"></i>
                            </span>
                        <?php else: ?>
                            <a href="/login" class="g-font-size-18 g-color-white g-color-gray-light-v1--hover">
                                <i class="fa fa-sign-in" aria-hidden="true" title="Авторизоваться"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Start Search -->
                    <div class="d-inline-block g-valign-middle g-pos-rel g-top-minus-1">
                        <a href="#" class="g-font-size-18 g-color-white g-color-gray-light-v1--hover"
                           aria-haspopup="true" aria-expanded="false" aria-controls="searchform-1"
                           data-dropdown-target="#searchform-1" data-dropdown-type="css-animation"
                           data-dropdown-duration="300" data-dropdown-animation-in="fadeInUp"
                           data-dropdown-animation-out="fadeOutDown">
                            <i class="fa fa-search"></i>
                        </a>
                        <!-- Start Search Form -->
                        <form onsubmit="location.href=`${this.action}${this.elements.search.value}`;return false;"
                              action="/search/" method="post" id="searchform-1"
                              class="u-searchform-v1 u-dropdown--css-animation u-dropdown--hidden g-bg-black g-pa-10 g-mt-10 g-box-shadow-none"
                              style="animation-duration: 300ms; right: -15px;">
                            <div class="input-group g-brd-primary--focus">
                                <input class="form-control rounded-0 u-form-control g-brd-gray-light-v3" type="search"
                                       name="search" value="" placeholder="Поле поиска ...">
                                <input type="hidden" name="id" value="316"/>
                                <div class="input-group-addon p-0">
                                    <button class="btn rounded-0 btn-primary btn-md g-font-size-14 g-px-18"
                                            type="submit">Найти
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- End Search Form -->
                    </div>
                    <!-- End Search -->

                </div>
                <!-- End Basket & Search -->

            </div>
        </div>
    </div>
</header>

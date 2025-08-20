<div class="col-lg-3 g-brd-left--lg g-brd-gray-light-v4 g-mb-30">
    <div class="g-pl-20--lg">
        <!-- Start Useful Links -->
        <div class="g-mb-20">
            <h3 class="h5 g-color-black g-font-weight-600 g-mb-10">Категории</h3>
            <ul class="list-unstyled g-font-size-13 mb-0">
                @foreach($categories as $category)
                    <li class="{{ @$_GET['category'] == $category->id ? "current-category" : ""  }}">
                        <a class="d-block u-link-v5 g-color-gray-dark-v4 rounded g-px-20 g-py-8"
                           href="{{route("post.index") . "?category=" . $category->id}}">
                            <i class="mr-2 fa fa-angle-right"></i> {!! $category->name !!}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- End Useful Links -->
        <hr class="g-brd-gray-light-v4 g-my-0">
        <div id="stickyblock-start" class="js-sticky-block g-sticky-block--lg g-pt-20"
             data-start-point="#stickyblock-start" data-end-point="#stickyblock-end">
            <!-- Start Publications -->
            <div class="g-mb-20">
                <h3 class="h5 g-color-black g-font-weight-600 mb-4">{{ $relative_title  }}</h3>
                <ul class="list-unstyled g-font-size-13 mb-0">

                    @if(isset($post))
                        @foreach($post->relatives as $item)
                            @include("components.aside.aside-post-item")
                        @endforeach
                    @elseif(isset($top_posts))
                        @foreach($top_posts as $item)
                            @include("components.aside.aside-post-item")
                        @endforeach
                    @endif

                    <li>
                        <article class="media g-mb-20">
                            <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                 src="assets/img-temp/100x100/img1.jpg" alt="Gravity">
                            <div class="media-body">
                                <h4 class="h6 g-color-black g-font-weight-600">Apple LLC</h4>
                                <p class="g-color-gray-dark-v4">I am alone, and feel the charm of existence in
                                    this spot, which was ...</p>
                                <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                   href="#">Follow</a>
                            </div>
                        </article>
                    </li>
                </ul>
            </div>
            <!-- End Publications -->
            <hr class="g-brd-gray-light-v4 g-mt-0 g-mb-20">
            <!-- Start Tags -->
            <div class="g-mb-0">
                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Blog Tags</h3>
                <ul class="u-list-inline mb-0">
                    <li class="list-inline-item g-mb-10">
                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                           href="#">Design</a>
                    </li>
                    <li class="list-inline-item g-mb-10">
                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                           href="#">Javascript</a>
                    </li>
                    <li class="list-inline-item g-mb-10">
                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                           href="#">HTML</a>
                    </li>
                    <li class="list-inline-item g-mb-10">
                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                           href="#">CSS</a>
                    </li>
                    <li class="list-inline-item g-mb-10">
                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                           href="#">Less</a>
                    </li>
                    <li class="list-inline-item g-mb-10">
                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                           href="#">Sass</a>
                    </li>
                    <li class="list-inline-item g-mb-10">
                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                           href="#">WordPress</a>
                    </li>
                </ul>
            </div>
            <!-- End Tags -->
        </div>
    </div>
</div>

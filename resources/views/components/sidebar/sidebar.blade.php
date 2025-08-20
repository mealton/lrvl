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
                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Это интересно</h3>
                <ul class="list-unstyled g-font-size-13 mb-0">
                    @foreach($top_posts as $item)
                        @include("components.sidebar.relative-post-item")
                    @endforeach
                </ul>
            </div>
            <!-- End Publications -->
            <hr class="g-brd-gray-light-v4 g-mt-0 g-mb-20">
            <!-- Start Tags -->
            <div class="g-mb-0">
                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Популярные метки</h3>
                <ul class="u-list-inline mb-0">
                    @foreach($top_tags as $tag)
                        <li class="list-inline-item g-mb-10">
                            <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                               href="{{route("post.index") . "?hashtag=" . $tag->name}}">{!! $tag->name !!}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- End Tags -->
        </div>
    </div>
</div>

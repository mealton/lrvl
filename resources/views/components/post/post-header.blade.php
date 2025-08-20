<header class="g-mb-30 mt-5">
    <h2 class="h1 g-mb-15 g-mt-minus-10">{!! html_entity_decode($post->title) !!}</h2>
    <ul class="list-inline d-sm-flex g-color-gray-dark-v4 mb-0">
        <li class="list-inline-item">
            <a href="{{route("post.index") . "?author=" . $post->user->id}}"
               class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover">
                {!! html_entity_decode($post->user->username) !!}
            </a>
        </li>
        <li class="list-inline-item g-mx-10">/</li>
        <li class="list-inline-item">
            {{$post->date}}
        </li>
        <li class="list-inline-item g-mx-10">/</li>
        <li class="list-inline-item g-mr-10">
            <a href="{{ route("post.show", $post->id)  }}#comments"
               class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover">
                <i class="icon-finance-206 u-line-icon-pro align-middle g-pos-rel g-top-1 mr-1"></i>
                {{count($post->comments)}}
            </a>
        </li>
        <li class="list-inline-item ml-auto">
            <i class="icon-eye u-line-icon-pro align-middle mr-1"></i> Просмотров {{$post->views}}
        </li>
    </ul>
    <hr class="g-brd-gray-light-v4 g-mt-25 g-mb-30">


    <!-- Start Tags -->
    <div class="g-mb-30">
        <h6 class="g-color-gray-dark-v1">
            <strong class="g-mr-5">Метки:</strong>
            @foreach(current($post->hashtags) as $tag)
                @if($tag->name)
                    <a class="u-tags-v1 g-font-size-12 g-brd-around g-brd-gray-light-v4 g-bg-primary--hover g-brd-primary--hover g-color-black-opacity-0_8 g-color-white--hover rounded g-py-6 g-px-15 g-mr-5 g-mb-5"
                       href="{{ route("post.index") . "?hashtag=" . $tag->name }}">
                        {{$tag->name}}
                    </a>
                @endif
            @endforeach
        </h6>
    </div>
    <!-- End Tags -->
</header>


@extends("layouts.main")
@section("content")
    <div class="g-pr-20--lg">
        <article class="g-mb-0">
            @include("components.post.post-header")
            <div class="g-font-size-16 g-line-height-1_8 g-mb-30">
                <div class="post-content my-5">
                    @foreach(current($post->contents) as $item)
                        @if($item->is_active)
                            @switch($item->type)
                                @case ("image")
                                    @include("components.post.tag-type.image")
                                    @break
                                @case ("subtitle")
                                    @include("components.post.tag-type.subtitle")
                                    @break
                                @case ("video")
                                    @include("components.post.tag-type.video")
                                    @break
                                @case ("text")
                                    @include("components.post.tag-type.text")
                            @endswitch
                        @endif
                    @endforeach
                </div>
            </div>

            <hr class="g-brd-gray-light-v4">

            <hr class="g-brd-gray-light-v4 g-mb-25">
            <!-- Related Articles -->
            <div class="g-mb-0">
                <div class="u-heading-v3-1 g-mb-30">
                    <h2 class="h5 u-heading-v3__title g-color-gray-dark-v1 text-uppercase g-brd-primary">
                        Похожие публикации
                    </h2>
                </div>
                <div class="row">
                    @foreach($post->relatives as $item)
                        <div class="col-lg-4 col-sm-6 g-mb-30" style="height: 140px;">
                            <a href="{{route("post.index") . "/" . $item->id}}">
                                <article>
                                    <figure class="u-shadow-v25 g-pos-rel g-mb-0">
                                        <img class="img-fluid w-100 h-100"
                                             style="object-fit: cover; object-position: center"
                                             src="{{ $item->image  }}" alt="{{$item->title}}">
                                        <figcaption class="g-pos-abs g-top-10 g-left-10">
                                        <span class="btn btn-xs u-btn-blue text-uppercase rounded-0">
                                            {{ $item->category  }}
                                        </span>
                                        </figcaption>
                                    </figure>
                                </article>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Start Author Block -->
            <div class="g-mb-30">
                <div class="u-heading-v3-1 g-mb-30">
                    <h2 class="h5 u-heading-v3__title g-color-gray-dark-v1 text-uppercase g-brd-primary">
                        Об авторе
                    </h2>
                </div>
                <div class="media g-brd-around g-brd-gray-light-v4 rounded g-pa-30 g-mb-20">
                    <img class="d-flex u-shadow-v25 g-width-80 g-height-80 rounded-circle g-mr-15"
                         src="{{$post->user->profile_image}}"
                         alt="{{$post->user->username}}">
                    <div class="media-body">
                        <h4 class="g-color-gray-dark-v1 g-mb-15">
                            <a class="u-link-v5 g-color-gray-dark-v1 g-color-primary--hover"
                               href="{{route("post.index") . "?author=" . $post->user->id}}">
                                {{$post->user->fullname ?? $post->user->username}}
                            </a>
                        </h4>
                        <div class="g-mb-15">
                            <p class="g-color-gray-dark-v2">
                                {!! html_entity_decode($post->user->about) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Author Block -->
            <!-- Start Add Comment -->
            @include("components.post.comments.comment-form")
            <!-- End Add Comment -->
            <!-- Start Comments -->
            @include("components.post.comments.comments")
            <!-- End Comments -->
        </article>
    </div>
@endsection








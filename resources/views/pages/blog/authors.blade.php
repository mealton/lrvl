@extends("layouts.main")

@section("content")

    <div class="authors-container">

        @foreach($authors as $item)
            <a href="{{route("post.index") . "?author=" . $item->id}}">
                <div class="media g-brd-around g-brd-gray-light-v4 rounded g-pa-30 h-100 position-relative">

                    <span class="btn btn-xs u-btn-blue text-uppercase rounded-0 position-absolute overflow-hidden"
                          style="top: 0;right: 0;">
                        Постов: {{ $item->post_count  }}
                    </span>

                    <img class="d-flex u-shadow-v25 g-width-80 g-height-80 rounded-circle g-mr-15"
                         src="{{$item->profile_image}}"
                         alt="{{$item->username}}">
                    <div class="media-body">
                        <h4 class="g-color-gray-dark-v1 g-mb-15">{{$item->fullname ?? $item->username}}</h4>
                        <div class="g-mb-15">
                            <p class="g-color-gray-dark-v2">
                                {!! html_entity_decode($item->about) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </a>

        @endforeach
    </div>
@endsection

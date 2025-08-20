<div class="g-mb-0">
    <div class="u-heading-v3-1 g-mb-30">
        <h2 class="h5 u-heading-v3__title g-color-gray-dark-v1 text-uppercase g-brd-primary">
            Комментарии
        </h2>
    </div>
    <div class="comments-container">
        @foreach($post->comments as $comment)
            <div class="media g-brd-around g-brd-gray-light-v4 g-pa-30 g-mb-30">
                <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
                     src="{{$comment->user->profile_image}}" alt="Gravity">
                <div class="media-body">
                    <div class="g-mb-15">
                        <h5 class="d-flex justify-content-between align-items-center h5 g-color-gray-dark-v1 mb-0">
                            <span class="d-block g-mr-10">{{$comment->user->username}}</span>
                        </h5>
                        <span class="g-color-gray-dark-v4 g-font-size-12">{{$comment->date}}</span>
                    </div>
                    <p>
                        {!! html_entity_decode($comment->comment) !!}
                    </p>
                    @if($comment->image)
                        <img src="{{$comment->image}}" class="img-fluid comment-img clickable" alt="">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

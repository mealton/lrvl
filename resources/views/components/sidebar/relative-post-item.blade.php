<li>
    <a href="{{route("post.index") . "/" . $item->id}}">
        <article class="media g-mb-20">
            <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3 {{ $item->is_hidden ? 'is-erotic' : '' }}"
                 src="{{$item->image}}" alt="{{$item->title}}">
            <div class="media-body">
                <h4 class="h6 g-color-black g-font-weight-600">{!! html_entity_decode($item->title) !!}</h4>
                <p class="g-color-gray-dark-v4 sidebar-post-item-description">
                    {!! html_entity_decode($item->introtext) !!}
                </p>
            </div>
        </article>
    </a>
</li>

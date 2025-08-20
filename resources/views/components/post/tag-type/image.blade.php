<figure class="mb-4 image-item-container" itemscope="" itemtype="http://schema.org/ImageObject">

    <blockquote class="blockquote">
        <p>
            <em itemprop="description">{!! html_entity_decode($item->description) !!}</em>
        </p>
    </blockquote>

    <figure class="publication-image-item-container">
        <img itemprop="contentUrl"
             style="cursor: default"
             class="img-fluid rounded publication-image-item"
             src="{{$item->content}}" alt="">

        <figcaption>
            <p style="text-align: right">
                @if($item->source)
                    <small>
                        Источник:
                        <cite title="Source Title">
                            <a href="{{$item->source}}"
                               target="_blank">{{ parse_url($item->source, PHP_URL_HOST) }}</a>
                        </cite>
                    </small>
                @endif
            </p>
        </figcaption>

    </figure>
    <p class="fs-5 img-text text-justify my-0" style="line-height: 1.6">
        {!! html_entity_decode($item->text) !!}
    </p>
</figure>

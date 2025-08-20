@if (strpos($item->content, 'youtube.com'))
    <figure class="mb-4 video-item-container" itemscope itemtype="http://schema.org/ImageObject">
        @if ($item->description)
            <blockquote class="blockquote">
                <p><em itemprop="description">{!! html_entity_decode($item->description) !!} </em></p>
            </blockquote>
        @endif
        <figure>
            <iframe width="1903" height="751"
                    style="max-width: 100%"
                    src="https://www.youtube.com/embed/{{ \App\Services\Post\Service::get_youtube_video_id($item->content)  }}"
                    title="{{$item->description}}"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </figure>
    </figure>
@else
    <figure class="mb-4 public-video-item" itemscope itemtype="http://schema.org/ImageObject">
        @if ($item->description)
            <blockquote class="blockquote">
                <p><em itemprop="description">{!! html_entity_decode($item->description) !!} </em></p>
            </blockquote>
        @endif
        <div style="display: inline-block;position: relative; max-width: 95%;" class="video-container video-item">
            <video itemprop="contentUrl"
                   src="{{ $item->content }}" controls="controls"
                   class="img-fluid"
                   onplay="this.parentElement.classList.remove('video-item');"
                   onpause="this.parentElement.classList.add('video-item')"
                   @if (strpos($item->poster, ".jpg"))
                   poster="{{$item->poster}}"
                @endif></video>
            <img src="{{asset("img/yt.png")}}" alt="" class="youtube-icon"
                 onclick="this.previousElementSibling.play(); ">
        </div>
    </figure>
@endif

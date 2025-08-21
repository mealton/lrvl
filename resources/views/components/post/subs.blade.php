@if(!empty($subs))
    <div class="sub-categories">
        @foreach($subs as $sub)
            <div class="card subcategory-card rounded-0 sub-categories__item u-shadow-v25">
                <a href="{{ route("post.index") . "?category=" .  $sub->id }}"
                   class="card-link d-block h-100">
                    <div class="card-body position-relative">
                        <h5 class="card-title">{!! html_entity_decode($sub->name) !!}</h5>
                        <p class="card-text">{!! html_entity_decode($sub->description) !!}</p>
                        @if($sub->is_hidden)
                            <img src="{{ asset("assets/img/18.png")  }} " alt="" class="img-18">
                        @endif
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif

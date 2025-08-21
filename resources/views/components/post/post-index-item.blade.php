<div class="post-item">
    <article class="row align-items-start u-block-hover">
        <div class="col-md-6 g-mb-30">
            <div class="g-overflow-hidden position-relative">

                <span
                    class="badge bg-danger px-2 py-1 shadow-1-strong mb-3 text-white position-absolute post-item__category-link">
                    <a class="text-white" href="{{route("post.index") . "?category=" . $item->category_id}}">
                        {{$item->category->name}}
                    </a>
                </span>


                <a href="{{route("post.index") . "/post/" . $item->id}}">
                    <img
                        class="img-fluid w-100 u-block-hover__main--mover-down g-mb-minus-6 {{ $item->category->is_hidden ? 'is-erotic' : '' }}"
                        src="{{ $item->image  }}" alt="{{ $item->title }}">
                </a>
            </div>
        </div>
        <div class="col-md-6 g-mb-30">
            <ul class="list-inline g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 g-mb-15">
                <li class="list-inline-item mr-0">
                    <a href="{{route("post.index") . "?author=" . $item->user->id}}">
                        {{$item->user->username}}
                    </a>
                </li>
                <li class="list-inline-item mx-2">·</li>
                <li class="list-inline-item">{{$item->date}}</li>
            </ul>
            <h2 class="h4 g-color-black g-font-weight-600 g-mb-15">
                <a class="u-link-v5 g-color-black g-color-primary--hover"
                   href="{{route("post.index") . "/post/" . $item->id}}">
                    @if(isset($_GET['search']))
                        {!!  preg_replace('/(' . urldecode(@$_GET['search']) . ')/iu','<mark>$1</mark>', html_entity_decode($item->title)) !!}
                    @else
                        {!!  html_entity_decode($item->title) !!}
                    @endif
                </a>
            </h2>
            <p class="g-color-gray-dark-v4 g-mb-15">
                {!! html_entity_decode( $item->introtext ) !!}
            </p>
        </div>
    </article>
    <hr class="g-mt-0 g-mb-30 g-mx-15">
</div>

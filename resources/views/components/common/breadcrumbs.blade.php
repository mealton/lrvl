@if(!empty($breadcrumbs))
    <section class="g-bg-white g-pt-45">
        <div class="container">
            <div class="d-sm-flex ">
                <div class="align-self-center" aria-label="breadcrumb">
                    <ul class="u-list-inline" itemscope="" itemtype="https://schema.org/BreadcrumbList">
                        @foreach($breadcrumbs as $position => $item)
                            @if(isset($item['current']))
                                <li class="list-inline-item g-color-primary" aria-current="page"
                                    itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                                    <span itemprop="item">
                                        <span itemprop="name">{!! $item['name']  !!}</span>
                                        <meta itemprop="position" content="{{$position}}">
                                    </span>
                                </li>
                            @else
                                <li class="list-inline-item g-mr-5" itemprop="itemListElement" itemscope=""
                                    itemtype="https://schema.org/ListItem">
                                    <a  class="u-link-v5 g-color-main" itemprop="item" href="{{$item['url']}}">
                                        <span itemprop="name">{!! $item['name'] !!}</span>
                                        <meta itemprop="position" content="{{$position}}">
                                    </a>
                                    <i class="g-color-main g-ml-5">/</i>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif

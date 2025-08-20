@if(!empty($breadcrumbs))
    <div class="row mb-3">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">

                    @foreach($breadcrumbs as $position => $item)
                        @if(isset($item['current']))
                            <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement"
                                itemscope=""
                                itemtype="https://schema.org/ListItem">
                    <span itemprop="item">
                        <span itemprop="name">{!! $item['name']  !!}</span>
                        <meta itemprop="position" content="{{$position}}">
                    </span>
                            </li>
                        @else
                            <li class="breadcrumb-item" itemprop="itemListElement" itemscope=""
                                itemtype="https://schema.org/ListItem">
                                <a itemprop="item" href="{{$item['url']}}">
                                    <span itemprop="name">{!! $item['name'] !!}</span>
                                    <meta itemprop="position" content="{{$position}}">
                                </a>
                            </li>
                        @endif
                    @endforeach

                </ol>
            </nav>
        </div>
    </div>
@endif

@if ($paginator->hasPages())
    <nav class="text-center g-px-15" aria-label="Page Navigation">
        <ul class="list-inline g-mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="list-inline-item float-left g-hidden-xs-down disabled" style="opacity: .5; pointer-events: none">
                    <span class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16"
                        aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span aria-hidden="true">
                                    <i class="fa fa-angle-left g-mr-5"></i>
                                </span>
                    </span>
                </li>
            @else
                <li class="list-inline-item float-left g-hidden-xs-down">
                    <a class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16"
                       href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
                                <span aria-hidden="true">
                                    <i class="fa fa-angle-left g-mr-5"></i>
                                </span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="list-inline-item" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="list-inline-item" aria-current="page">
                                <span class="u-pagination-v1__item u-pagination-v1-4 u-pagination-v1-4--active g-rounded-50 g-pa-7-14"
                                   >{{ $page }}</span>
                            </li>
                        @else
                            <li class="list-inline-item">
                                <a class="u-pagination-v1__item u-pagination-v1-4 g-rounded-50 g-pa-7-14" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="list-inline-item float-right g-hidden-xs-down">
                    <a class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16"
                       href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">
                                     <i class="fa fa-angle-right g-ml-5"></i>
                                </span>
                    </a>
                </li>
            @else
                <li class="list-inline-item float-right g-hidden-xs-down"
                    style="opacity: .5; pointer-events: none" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16"
                        aria-label="@lang('pagination.next')">
                                <span aria-hidden="true">
                                     <i class="fa fa-angle-right g-ml-5"></i>
                                </span>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

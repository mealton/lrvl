@extends("layouts.main")

@section("content")
    <!-- Start Blog Minimal Content -->

    <div class="g-pr-0--lg">
        <!-- Start Blog Articles -->

        @foreach($posts as $item)
            @include("components.post.post-index-item")
        @endforeach


        <!-- End Blog Articles -->
    </div>
    <!-- Start Blog Pagination -->
    {{ $posts->links() }}
    <!-- End Blog Pagination -->
    <!-- End Blog Minimal Content -->
@endsection

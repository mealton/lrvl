@extends("layouts.blog")
@section("content")
    @include("components.post.breadcrumbs")
    @include("components.post.description")

    <div class="post-content my-5">
        @foreach(current($post->contents) as $item)
            @if($item->is_active)
                @switch($item->tag)
                    @case ("image")
                    @include("components.post.tag-type.image")
                    @break
                    @case ("subtitle")
                    @include("components.post.tag-type.subtitle")
                    @break
                    @case ("video")
                    @include("components.post.tag-type.video")
                    @break
                    @case ("text")
                    @include("components.post.tag-type.text")
                @endswitch
            @endif
        @endforeach
    </div>

    <section class="mb-5">
        <div class="card bg-light">
            <div class="card-body">
                <!-- Comment form-->
            @auth
                @include("components.post.comment-form")
            @endauth
            <!-- Comment with nested comments-->
                <div class="container my-3">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 col-lg-12">
                            <div class="card text-dark">
                                <div class="card-body p-4 comments-list">
                                    @include("components.post.comments")
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


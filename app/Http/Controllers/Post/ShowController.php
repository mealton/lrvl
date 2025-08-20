<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;

class ShowController extends BaseController
{

    public function __invoke(Post $post)
    {

        $title = $post->title;
        $post = $this->service->show($post);
        $categories = $this->service->top_categories();
        $breadcrumbs = $this->service->breadcrumbs($post->category_id);
        $top_posts = $this->service->top_posts();
        $route = $this->service->get_route();
        $top_tags = $this->service->top_tags();

        $variables = compact('post', 'title', 'categories', 'top_posts', 'breadcrumbs',
            'route', 'top_tags');

        return view("pages.blog.show", $variables);
    }


}

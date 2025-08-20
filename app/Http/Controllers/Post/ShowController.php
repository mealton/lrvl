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
        $relative_title = "Похожие публикации";
        $route = $this->service->get_route();

        $variables = compact('post', 'title', 'categories', 'relative_title', 'breadcrumbs', 'route');


        return view("pages.blog.show", $variables);
    }


}

<?php

namespace App\Http\Controllers\Post;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

use http\Env\Request;

class AllController extends BaseController
{

    public function __invoke(FilterRequest $request)
    {
        $title = "Все посты";
        $breadcrumbs = [];
        $subs = [];

        $filter = app()->make(PostFilter::class, ['queryParams' => []]);

        $all_posts = $this->service->getPosts($filter, $this->per_page);

        $posts = $all_posts['items'];
        $categories = $all_posts['categories'];
        $top_posts = $all_posts['top_posts'];
        $top_tags = $all_posts['top_tags'];
        $route = $all_posts['route'];

        $variables = compact('title', 'posts', 'categories', 'top_posts',
            'breadcrumbs', 'subs', 'route', 'top_tags');

        return view("pages.blog.index", $variables);
    }

}

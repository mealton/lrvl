<?php

namespace App\Http\Controllers\Post;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

use http\Env\Request;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $title = "Блог";
        $breadcrumbs = [];
        $subs = [];
        $data = $request->validated();

        if (empty($data))
            $data["no-erotic"] = "1";

        $filter = app()->make(PostFilter::class, ['queryParams' => $data]);

        if (@$data['category']) {
            $breadcrumbs = $this->service->breadcrumbs($data['category']);
            $subs = $this->service->getSubs($data['category']);
            $title = Category::find($data['category'])->name;
        } elseif (@$data['tag']) {
            $title = "#" . $data['tag'];
        } elseif (@$data['author']) {
            $title = "Публикации автора " . User::find($data['author'])->username;
        }

        $index_posts = $this->service->getPosts($filter, $this->per_page);

        $posts = $index_posts['items'];
        $categories = $index_posts['categories'];
        $top_posts = $index_posts['top_posts'];
        $top_tags = $index_posts['top_tags'];
        $route = $index_posts['route'];

        $variables = compact('title', 'posts', 'categories', 'top_posts',
            'breadcrumbs', 'subs', 'route', 'top_tags');

        return view("pages.blog.index", $variables);
    }

}

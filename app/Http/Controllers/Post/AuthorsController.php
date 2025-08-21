<?php

namespace App\Http\Controllers\Post;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

use http\Env\Request;

class AuthorsController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $title = "Авторы";
        $data = $this->service->getAuthors();

        $authors = $data['authors'];
        $categories = $data['categories'];
        $top_posts = $data['top_posts'];
        $top_tags = $data['top_tags'];

        $variables = compact('title', 'authors', 'categories', 'top_posts', 'top_tags');

        return view("pages.blog.authors", $variables);
    }

}

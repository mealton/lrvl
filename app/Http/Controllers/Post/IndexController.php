<?php

namespace App\Http\Controllers\Post;

use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

//use http\Env\Request;

class IndexController extends BaseController
{
    //C:\ProgramData\ComposerSetup\bin\composer.phar

    private $per_page = 10;

    public function __invoke(FilterRequest $request)
    {
        $title = "Блог";
        $breadcrumbs = [];
        $subs = [];
        $data = $request->validated();
        $filter = app()->make(PostFilter::class, ['queryParams' => $data]);

        if (@$data['category']) {
            $breadcrumbs = $this->service->breadcrumbs($data['category']);
            $subs = Category::where(['parent_id' => $data['category'], 'is_active' => 1])->get();
            $title = Category::find($data['category'])->name;
        }elseif (@$data['tag']){
            $title = "#" . $data['tag'];
        }elseif (@$data['author']){
            $title = "Публикации автора " . User::find($data['author'])->username;
        }

        $posts = $this->service->index($filter, $this->per_page);
        $categories = $this->service->top_categories();
        $relative_title = "Это интересно!";
        $top_posts = $this->service->top_posts();
        $route = $this->service->get_route();

        $variables = compact('title', 'posts', 'categories', 'relative_title', 'top_posts',
            'breadcrumbs', 'subs', 'route');

        return view("pages.blog.index", $variables);
    }

}

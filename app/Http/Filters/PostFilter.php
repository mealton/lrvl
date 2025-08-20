<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PostFilter extends AbstractFilter
{
    const SEARCH = 'search';
    const TAG = 'tag';
    const CATEGORY_ID = 'category';
    const AUTHOR_ID = 'author';


    protected function getCallbacks()
    {
        return [
            self::SEARCH => [$this, 'search'],
            self::TAG => [$this, 'tag'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::AUTHOR_ID => [$this, 'authorId'],
        ];
    }

    public function search(Builder $builder, $value)
    {
        $builder
            ->where('title', 'like', "%{$value}%")
            ->orWhere('introtext', 'like', "%{$value}%");
    }

    public function tag(Builder $builder, $value)
    {
        $builder
            ->select(DB::raw("posts.*"))
            ->rightJoin('hashtags', 'hashtags.publication_id', "=", 'posts.id')
            ->where('hashtags.name', '=', $value);
    }

    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }

    public function authorId(Builder $builder, $value)
    {
        $builder->where('user_id', $value);
    }
}

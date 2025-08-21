<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PostFilter extends AbstractFilter
{
    const SEARCH = 'search';
    const TAG = 'hashtag';
    const CATEGORY_ID = 'category';
    const AUTHOR_ID = 'author';
    const NO_EROTIC = 'no-erotic';


    protected function getCallbacks()
    {
        return [
            self::SEARCH => [$this, 'search'],
            self::TAG => [$this, 'hashtag'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::AUTHOR_ID => [$this, 'authorId'],
            self::NO_EROTIC => [$this, 'noErotic'],
        ];
    }

    public function search(Builder $builder, $value)
    {
        $builder
            ->where('title', 'like', "%{$value}%")
            ->orWhere('introtext', 'like', "%{$value}%");
    }

    public function hashtag(Builder $builder, $value)
    {
        $builder
            ->select(DB::raw("posts.*"))
            ->rightJoin('hashtags', 'hashtags.post_id', "=", 'posts.id')
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

    public function noErotic(Builder $builder)
    {
        $builder
            ->select(DB::raw("posts.*"))
            ->rightJoin('categories', 'posts.category_id', "=", 'categories.id')
            ->where('categories.is_hidden', '=', 0);
    }
}

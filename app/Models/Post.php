<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'views',
        'likes',

    ];

    public function contents()
    {
        return $this->hasMany(Content::class, "post_id", "id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id",  "id");
    }

    public function hashtags()
    {
        return $this->hasMany(Hashtag::class, "post_id",  "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id",  "id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, "post_id", "id");
    }
}

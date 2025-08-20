<?php

namespace App\Http\Controllers\Post;

use App\Http\Resources\Post\LikeResource;
use App\Models\Post;

class UpdateController extends BaseController
{

    public function like(Post $post)
    {
        $post->update(['likes' => $post->likes + 1]);
        return new LikeResource($post);
    }


}

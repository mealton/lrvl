<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $title = "Gallery";
        return view("pages.gallery.index", compact('title'));
    }
}

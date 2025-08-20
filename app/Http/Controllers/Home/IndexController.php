<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $title = "Home";
        return view("pages.home.index", compact('title'));
    }
}


//<a href="[[++site_url]][[#246.uri]]" target="_blank">литейном</a>

<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        $title = "Страница пользователя " . (@Auth::user()->username);
        return view("pages.profile.index", compact('title'));
    }
}

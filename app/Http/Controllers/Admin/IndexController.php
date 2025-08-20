<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        $this->authorize('view', auth()->user());
        $title = "Страница администрирования";
        $pagetitle = "Страница администрирования. Здравствуйте, " . (@Auth::user()->fullname ?: @Auth::user()->username);
        return view("pages.admin.index", compact('title', 'pagetitle'));
    }
}

<?php


namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Services\Post\Service;

class BaseController extends Controller
{

    public $service;

    protected $per_page = 15;


    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller as Controller;

abstract class BaseController extends Controller
{
    protected $request;

    protected $data;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->data = [];
        $this->data['route'] = \Request::route()->getName();
        $this->data['routes'] = self::getRoutes();
        $this->request = $request;
    }

    /**
     * Get routes config
     *
     * @return array
     */
    public static function getRoutes()
    {
        return [
            'posts.get' => route('posts.get', []),
            'posts.storeMedia' => route('posts.storeMedia', []),
        ];
    }
}

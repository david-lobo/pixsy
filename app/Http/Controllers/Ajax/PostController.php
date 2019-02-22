<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Media;
use Auth;
use Session;

class PostController extends BaseController
{
    public function __construct(Request $request)
    {
        //$this->middleware(['auth', 'clearance'])->except('index', 'show');
        parent::__construct($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::filter($this->request)->with('user')->orderby('id', 'desc')->paginate(6); //show only 5

        $posts->appends(request()->query());

        return $this->sendResponse($posts->toArray(), 'Category created successfully.');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Media;
use Auth;
use Session;


class PostController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'clearance'])->except('index', 'show', 'test');
        parent::__construct($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('data', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        $posts = Post::orderby('id', 'desc')->paginate(10);

        return view('posts.test', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('posts.create')->with('data', $this->data);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            'description' =>'required',
            'media' => 'required|array',
            'media.*' => 'required|string'
            ]);

        $user = auth()->user();
        $title = $request['title'];
        $description = $request['description'];
        $postData = $request->only('title', 'description');
        $postData['user_id'] = $user->id;

        $post = Post::create($postData);

        foreach ($request->input('media', []) as $file) {
            $post->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('gallery');
        }

        //Display a successful message upon save
        return redirect()->route('home')
            ->with('flash_message', 'Image has been uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id); //Find post of id = $id

        return view ('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $data = $this->data;

        //var_dump($post->media);
        return view('posts.edit', compact('post', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required|max:100',
            'description'=>'required',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        if (count($post->media) > 0) {
            foreach ($post->media as $media) {
                if (!in_array($media->file_name, $request->input('media', []))) {
                    $media->delete();
                }
            }
        }

        $media = $post->media->pluck('file_name')->toArray();

        foreach ($request->input('media', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $post->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('gallery');
            }
        }

        return redirect()->route('posts.show',
            $post->id)->with('flash_message',
            'Article, '. $post->title.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('flash_message',
             'Article successfully deleted');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}

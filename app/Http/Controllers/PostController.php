<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //for home page and non authenticate users only can see.
    public function all(Request $request)
    {
        
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }

    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $id = auth()->id();
        $posts = Post::where('user_id', $id)->latest()->get();
        return view('profile', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = Validator::make($request->all(), [
            'title' => ['required', 'min:3', 'max:25'],
            'content' => ['required'],
        ]);

        if ($incomingFields->fails()) {
            return redirect('create')
                ->withErrors($incomingFields)
                ->withInput();
        }

        $incomingFieldsData = $incomingFields->validated();
        $incomingFieldsData['user_id'] = auth()->id();
        Post::create($incomingFieldsData);

        return redirect()->route('profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $auth = (auth()->id() === $post->user_id);

        // Return the view with the post and auth status
        return view('post', [
            'post' => $post,
            'auth' => $auth
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('update', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post)
    {
        $post = Post::findOrFail($post);

        if (auth()->id() !== $post['user_id']) {
            return false;
        }

        $incomingFields = Validator::make($request->all(), [
            'title' => ['required', 'min:3', 'max:25'],
            'content' => ['required'],
        ]);

        if ($incomingFields->fails()) {
            return redirect()->route('posts.update')
                ->withErrors($incomingFields)
                ->withInput();
        }
        $incomingFieldsData = $incomingFields->validated();

        $post->update($incomingFieldsData);

        return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // $post = Post::findOrFail($post);
        if (auth()->id() !== $post['user_id']) {
            return false;
        }
        $post->delete();
        return redirect()->route('profile');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate('10');
        return view('permission/post/index', compact('posts'));
    }

    public function create()
    {
        return view('permission/post/create');
    }

    public function store(PostRequest $request)
    {
        // TODO: Just allow file or embeb content
        $post = Post::create([
            'user_id' => auth()->user()->id
        ] + $request->all());

        if ($request->file('file')) {
            $post->image = $request->file('file')->store('posts', 'public');
        }
        $post->save();

        return back()->with('status', 'Article id ' . $post->id . ' created!!!');
    }

    public function edit(Post $post)
    {
        return view('permission/post/edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        if ($request->file('file')) {
            Storage::disk('public')->delete($post->image);
            $post->image = $request->file('file')->store('posts', 'public');
        }
        $post->save();

        return back()->with('status', 'Article updated!!!');
    }

    public function destroy(Post $post)
    {
        if ($post->image != '') Storage::disk('public')->delete($post->image);
        $post->delete();
        return back()->with('status', 'Article deleted!!!');
    }
}

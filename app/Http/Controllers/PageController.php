<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function posts()
    {
        return view('public.posts', [
            'posts' => Post::with('user')->latest()->paginate('6')
        ]);
    }

    public function post(Post $post)
    {
        return view('public.post', ['post' => $post]);
    }
}

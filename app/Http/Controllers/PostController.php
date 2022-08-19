<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::where(['status' => true])->latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        $cookie = $post->increseViews();

        return response()->view('posts.show', [
            'post' => $post
        ])->withCookie($cookie);
    }
}

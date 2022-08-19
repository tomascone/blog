<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Post;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::whereIn('id', auth()->user()->bookmarks->pluck('post_id'))->where([
            'status' => true
        ])->latest()->paginate(6);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookmarkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        Bookmark::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return back()->with('success', 'The post was added to your bookmarks!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function show(Bookmark $bookmark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Bookmark::firstWhere([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ])->delete();

        return back()->with('success', 'The post was removed from your bookmarks!');
    }
}

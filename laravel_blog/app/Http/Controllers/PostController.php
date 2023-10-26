<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $kolbasz = Post::all();
        $kolbasz = Post::with('user') -> get();
        return view('posts.index', [
            'posts' => $kolbasz
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', [
            'users' => User::all(),
            'tags' => \App\Models\Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request -> validate([
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:20',
            'author_id' => 'required|integer|exists:users,id',
            'tags[]' => 'array',
            'tags.*' => 'integer|distinct|exists:tags,id'
        ], [
            'title.min' => 'Hoppácska!'
        ]);

        // itt feltételezhetem, hogy minden jó :)
        $post = Post::create($validated);
        $post -> tags() -> sync($validated['tags'] ?? []);
        Session::flash('post-created');
        return redirect() -> route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'users' => User::all(),
            'tags' => \App\Models\Tag::all(),
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request -> validate([
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:20',
            'author_id' => 'required|integer|exists:users,id',
            'tags[]' => 'array',
            'tags.*' => 'integer|distinct|exists:tags,id'
        ], [
            'title.min' => 'Hoppácska!'
        ]);

        // itt feltételezhetem, hogy minden jó :)
        $post -> update($validated);
        $post -> tags() -> sync($validated['tags'] ?? []);
        Session::flash('post-updated');
        return redirect() -> route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

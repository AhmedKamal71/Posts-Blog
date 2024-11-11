<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = Post::with('user')->get();
            return view('posts.index', compact('posts'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch posts');
        }
    }

    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $validatedData['user_id'] = Auth::id();
            Post::create($validatedData);
            return redirect()->route('posts.index')->with('success', 'Post created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create post');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $post = Post::with('user', 'comments.user')->findOrFail($id);
            return view('posts.show', compact('post'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch post');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $post = Post::findOrFail($id);

            if (Auth::id() !== $post->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to edit this post.');
            }

            return view('posts.edit', compact('post'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch post for editing');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $validatedData = $request->validated();
        try {
            $post = Post::findOrFail($id);

            if (Auth::id() !== $post->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to update this post.');
            }

            $post->update($validatedData);

            return redirect()->route('posts.index')->with('success', 'Post updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update post');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);

            if (Auth::id() !== $post->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to delete this post.');
            }
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete post');
        }
    }
}

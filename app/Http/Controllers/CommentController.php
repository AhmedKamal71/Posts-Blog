<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $comments = Comment::with('user')->get();
            return view('comments.adminComments', compact('comments'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch comments');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        return view('comments.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, Post $post)
    {
        try {
            Log::info('Store Comment Request:', $request->all());
            $validatedData = $request->validated();
            $validatedData['user_id'] = Auth::id();
            $post->comments()->create($validatedData);
            return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add comment. Please try again.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $comment = Comment::with('user')->findOrFail($id);
            return view('comments.show', compact('comment'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch comment');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $comment = Comment::findOrFail($id);

            if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
                return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
            }

            return view('comments.edit', compact('comment'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch comment for editing');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, string $id)
    {
        try {
            $comment = Comment::findOrFail($id);

            if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
                return redirect()->back()->with('error', 'You are not authorized to update this comment.');
            }

            $comment->update($request->validated());

            return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update comment');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $comment = Comment::findOrFail($id);

            if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
                return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
            }

            $comment->delete();

            return redirect()->back()->with('success', 'Comment deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete comment');
        }
    }
}

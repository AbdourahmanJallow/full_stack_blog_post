<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    //

    public function store(Request $request, Post $post, Comment $parentComment = null)
    {
        $user = $request->user();

        // $commentValidate = $request->validate(['content' => ['bail', 'required', 'max:500']]);

        $comment = Comment::create([
            'user_id' => $user ? $user->id : null,
            'post_id' => $post->id,
            'content' => $request->comment,
            'parent_id' => $parentComment ? $parentComment->id : null,
        ]);

        return Redirect::back()->with('success', 'comment added successfully');
    }

    public function destroy(Request $request, Post $post, Comment $comment)
    {

        if ($comment->user_id !== $request->user()->id) {
            return redirect()->back()->with('error', 'Comment not found');
        }

        $comment->delete();

        return Redirect::back()->with('success', 'Comment deleted successfully.');
    }

    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Comment not found');
        }

        $comment->update($request->all());

        return Redirect::back()->with('success', 'Comment updated successfully.');
    }
}

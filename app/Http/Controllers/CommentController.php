<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    //

    public function store(Request $request, Post $post)
    {
        $user = $request->user();

        // $commentValidate = $request->validate(['content' => ['bail', 'required', 'max:500']]);

        $comment = Comment::create([
            'user_id' => $user ? $user->id : null, 'post_id' => $post->id, 'content' => $request->comment
        ]);

        return Redirect::back()->with('success', 'comment added successfully');
    }
}

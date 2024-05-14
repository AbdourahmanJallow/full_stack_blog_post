<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function store(LikeRequest $request, Post $post)
    {
        // route => /posts/{post}/like

        // first find if user has already liked post
        $userLike = Like::where('user_id', $request->user()->id)->where('post_id', $post->id)->first();

        if ($userLike) {
            return Redirect::back()->with('error', 'You have already liked this post.');
        }

        Like::create(['user_id' => $request->user()->id, 'post_id' => $post->id]);

        return Redirect::back()->with('success', 'Like successfully.');
    }

    public function destroy(LikeRequest $request, Post $post)
    {
        // route => /posts/{post}/destroylike

        // first find if user has liked post
        $userLike = Like::where('user_id', $request->user()->id)->where('post_id', $post->id)->first();

        if (!$userLike) {
            return Redirect::back()->with('error', 'You have not liked this post.');
        }

        $userLike->delete();

        return Redirect::back()->with('success', 'Like removed successfully.');
    }
}

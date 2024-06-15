<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{

    public function index(Request $request): View
    {
        return view('welcome', ["posts" => Post::orderBy('created_at', 'DESC')->get()]);
    }


    public function create(Request $request): View
    {
        return view('create-post');
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $post = Post::create(["title" => $request->title, "content" => $request->content, "user_id" => auth()->user()->id]);

        $imageName = '';

        if ($request->hasFile('image')) {
            $validate = $request->validate(['image' => 'image|mimes:jpg,png,jpeg,svg|max:2048']);

            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('/assets/images/'), $imageName);

            $imageName = $request->getSchemeAndHttpHost() . '/assets/images/' . $imageName;
        }

        $post->image = $imageName;
        $post->save();

        return redirect()->route('welcome');
    }

    public function show(Post $post): View
    {
        $isLiked = null;
        $isDisliked = null;

        if (auth()->user()) {
            $isLiked = $post->likes()->where('user_id', auth()->user()->id)->first();

            $isDisliked = $post->dislikes()->where('user_id', auth()->user()->id)->first();
        }

        // $post->content = nl2p($post->content);

        return view('post-view', ['post' => $post, 'blog_owner' =>  $post->user, 'isliked' => $isLiked, 'isDisliked' => $isDisliked],);
    }


    public function edit(Post $post): View
    {
        return view('update-post', ['post' => $post]);
    }
    public function update(Post $post)
    {
        $foundPost = Post::where('slug', $post->slug)->where('user_id', auth()->user()->id)->first();

        if (!$foundPost) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $foundPost->update(request()->all());

        return
            Redirect::route('profile.edit')->with('status', 'Post updated successfully');
    }


    public function delete(Post $post): RedirectResponse
    {
        $foundPost = Post::where('slug', $post->slug)->where('user_id', auth()->user()->id)->first();

        if (!$foundPost) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $imageName = public_path('assets/images/' . basename($foundPost->image));

        if (File::exists($imageName)) {
            File::delete($imageName);
        }

        $foundPost->delete();

        return
            Redirect::route('profile.edit')->with('status', 'Post deleted successfully.');
    }
}

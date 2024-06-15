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

    public function readPost(Request $request): View
    {
        $post = Post::findOrFail($request->route('id'));

        $isLiked = null;
        $isDisliked = null;

        if ($request->user()) {
            $isLiked = $post->likes()->where('user_id', $request->user()->id)->first();

            $isDisliked = $post->dislikes()->where('user_id', $request->user()->id)->first();
        }

        return view('post-view', ['post' => $post, 'blog_owner' =>  $post->user, 'isliked' => $isLiked, 'isDisliked' => $isDisliked],);
    }


    public function edit(Request $request): View
    {
        return view('update-post', ['post' => Post::find($request->route('id'))]);
    }
    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', $request->user()->id)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $post->update($request->all());

        return
            Redirect::route('profile.edit')->with('status', 'Post updated successfully');
    }


    public function delete(Request $request, $id): RedirectResponse
    {
        $post = Post::where('id', $id)->where('user_id', $request->user()->id)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $imageName = public_path('assets/images/' . basename($post->image));

        if (File::exists($imageName)) {
            File::delete($imageName);
        }

        $post->delete();

        return
            Redirect::route('profile.edit')->with('status', 'Post deleted successfully.');
    }
}

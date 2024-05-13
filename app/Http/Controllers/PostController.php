<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "title" => ['bail', 'required', 'unique:posts', 'max:50'],
            "content" => ['required', 'max:5000']
        ]);

        $user = $request->user();

        $post = Post::create(["title" => $request->title, "content" => $request->content, "user_id" => $user->id]);

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
        $post = Post::find($request->route('id'));
        $owner = User::find($post->user_id);

        return view('post-view', ['post' => $post, 'blog_owner' => $owner,]);
    }


    public function edit(Request $request): View
    {
        return view('update-post', ['post' => Post::find($request->route('id'))]);
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $user = $request->user();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        if ($user->id != $post->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to update this post.');
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('welcome')->with('success', 'Post updated successfully');
    }


    public function delete(Request $request, $id): RedirectResponse
    {
        $post = Post::find($id);
        $user = $request->user();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        if ($user->id != $post->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();

        return redirect()->route('welcome')->with('success', 'Post deleted successfully');
    }

    public function comment(Request $request, $post_id)
    {
        // $post_id = $request->route('id');
        $user = $request->user();

        // $commentValidate = $request->validate(['content' => ['bail', 'required', 'max:500']]);

        // $post = Post::find($post_id);

        // if (!$post) {
        //     return
        //         Redirect::back()->with('error', 'Post not found.');
        // }

        $comment = Comment::create(['user_id' => $user->id, 'post_id' => $post_id, 'content' => $request->comment]);

        // $post->comments()->save($comment);

        return Redirect::back()->with('success', 'Comment created successfully');
    }


    // public function uploadImage(Request $request): string
    // {
    //     $validate = $request->validate(['image' => 'image|mimes:jpg,png,jpeg,svg|max:2048']);

    //     $imageName = time() . '.' . $request->image->extension();
    //     $request->image->move(public_path('images'), $imageName);

    //     return $imageName;
    // }
}

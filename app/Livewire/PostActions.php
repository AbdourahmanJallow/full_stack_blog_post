<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class PostActions extends Component
{

    public $isliked;
    public $post;
    public $totalLikes;

    public function mount($isliked, $postId)
    {
        $this->isliked = $isliked;
        $this->post = Post::findOrFail($postId);
        $this->totalLikes = Like::where('post_id', $postId)->count();
    }

    public function storelike()
    {
        // first find if user has already liked post
        $userLike = Like::where('user_id', auth()->user()->id)->where('post_id', $this->post->id)->first();

        if ($userLike) {
            return Redirect::back()->with('error', 'You have already liked this post.');
        }

        $this->isliked = Like::create(['user_id' => auth()->user()->id, 'post_id' => $this->post->id]);
        $this->totalLikes = Like::where('post_id', $this->post->id)->count();
    }

    public function destroylike()
    {
        // first find if user has liked post
        $userLike = Like::where('user_id', auth()->user()->id)->where('post_id', $this->post->id)->first();

        if (!$userLike) {
            return Redirect::back()->with('error', 'You have not liked this post.');
        }

        $userLike->delete();
        $this->isliked = null;
        $this->totalLikes = Like::where('post_id', $this->post->id)->count();
    }
    public function render()
    {
        return view('livewire.post-actions');
    }
}

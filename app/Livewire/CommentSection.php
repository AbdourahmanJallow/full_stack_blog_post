<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentSection extends Component
{
    public $post;

    #[Validate('required')]
    public $comment = '';

    public function mount($postId)
    {
        $this->post = Post::findOrFail($postId);
    }

    public function store()
    {
        $this->validate();
        $user = auth()->user();

        $comment = Comment::create([
            'user_id' => $user ? $user->id : null, 'post_id' => $this->post->id, 'content' => $this->comment
        ]);
        $this->comment = '';

        session()->flash('status', 'comment added succesfully.');
    }
    public function render()
    {
        return view('livewire.comment-section');
    }
}

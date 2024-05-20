<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentSection extends Component
{
    public $post;
    #[Validate('required')]
    public $content = ''; //text input
    protected $listeners = ['commentDeleted' => 'refreshComments'];


    public function mount($postId)
    {
        $this->post = Post::findOrFail($postId);
        // $this->comment = Comment::findOrFail($commentId);
    }

    public function store()
    {
        $this->validate();
        $user = auth()->user();

        Comment::create([
            'user_id' => $user ? $user->id : null,
            'post_id' => $this->post->id,
            'content' => $this->content
        ]);

        $this->content = '';

        $this->refreshComments();
    }

    #[On('commentDeleted')]
    public function refreshComments()
    {
        $this->post->load(['comments' => function ($query) {
            $query->topLevel()->with('children');
        }]);
    }

    // public function destroy(Comment $comment)
    // {

    //     if ($this->comment->user_id !== auth()->user()->id) {
    //         return redirect()->back()->with('error', 'Comment not found');
    //     }

    //     $comment->delete();

    //     return Redirect::back()->with('success', 'Comment deleted successfully.');
    // }

    // public function update(Comment $comment)
    // {
    //     if ($comment->user_id !== auth()->user()->id) {
    //         return redirect()->back()->with('error', 'Comment not found');
    //     }

    //     $comment->update($this->form->all());

    //     return Redirect::back()->with('success', 'Comment updated successfully.');
    // }
    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => $this->post->comments->where('parent_id', null),
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentCard extends Component
{
    public $comment;
    public $showInput = false;
    public $isLast;

    #[Validate('required')]
    public $reply = '';
    public function mount($comment, $isLast)
    {
        $this->comment = $comment;
        $this->isLast = $isLast;
    }

    public function toggleInput()
    {
        $this->showInput = !$this->showInput;
    }

    public function store()
    {
        $this->validate();
        $user = auth()->user();

        Comment::create([
            'user_id' => $user ? $user->id : null,
            'post_id' => $this->comment->post_id,
            'content' => $this->reply,
            'parent_id' => $this->comment->id
        ]);

        $this->reply = '';
    }

    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Comment not found');
        }

        $comment->delete();

        $this->dispatch('commentDeleted');
    }

    public function update(Comment $comment)
    {
        if ($comment->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Comment not found');
        }

        $comment->update($this->form->all());

        return Redirect::back()->with('success', 'Comment updated successfully.');
    }
    public function render()
    {
        return view('livewire.comment-card');
    }
}

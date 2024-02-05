<?php

namespace App\Livewire\Auth;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Posts extends Component
{

    public $posts;

    #[On('postDeleted'), On('postRestored')]
    public function mount()
    {
        if (!Auth::user()->hasRole('moderator') && !Auth::user()->hasRole('super-admin')) {
            $this->posts = Post::where('user_id', Auth::user()->id)->get();
        } else {
            $this->posts = Post::withTrashed()->get();
        }
    }

    public function editPost(Post $post)
    {
        return redirect()->to(route('update-post', ['post' => $post]));
    }

    public function restorePost(Post $post)
    {
        $post->restore();

        $this->dispatch('postRestored');
    }

    public function deletePost(Post $post)
    {
        $post->delete();

        $this->dispatch('postDeleted');
    }

    #[Layout('layouts.dauth')]
    public function render()
    {
        return view('livewire.auth.posts');
    }
}

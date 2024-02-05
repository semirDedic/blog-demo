<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\PostForm;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UpdatePost extends Component
{
    public PostForm $form;

    public $tabs = [];

    public function mount(Post $post)
    {
        $this->tabs = config('translatable.locales');

        $this->form->setPost($post);
    }

    public function save()
    {
        $this->form->update();

        session()->flash('status', 'Post successfully updated.');

        return $this->redirect(route('auth.posts'));
    }

    #[Layout('layouts.dauth')]
    public function render()
    {
        return view('livewire.auth.update-post');
    }
}

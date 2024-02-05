<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\PostForm;
use Astrotomic\Translatable\Locales;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreatePost extends Component
{
    public PostForm $form;

    public $tabs = [];

    public function mount()
    {
        $this->tabs = config('translatable.locales');
    }

    public function save()
    {
        $this->form->store();

        return $this->redirect(route('auth.posts'));
    }

    #[Layout('layouts.dauth')]
    public function render()
    {
        return view('livewire.auth.create-post');
    }
}

<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\PostForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public PostForm $form;

    public $tabs = [];

    #[On('uploadPhoto')]
    public function mount()
    {
        $this->tabs = config('translatable.locales');
    }

    public function save()
    {
        $this->form->store();

        return $this->redirect(route('auth.posts'));
    }

    public function uploadPhoto()
    {
        $this->dispatch('uploadPhoto');
    }

    #[Layout('layouts.dauth')]
    public function render()
    {
        return view('livewire.auth.create-post');
    }
}

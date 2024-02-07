<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Astrotomic\Translatable\Locales;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post;

    #[Validate]
    public $translations = [
        'bs' => [
            'title' => '',
            'text' => '',
            'excerpt' => '',
            'h1' => '',
            'slug' => '',
        ],
        'en' => [
            'title' => '',
            'text' => '',
            'excerpt' => '',
            'h1' => '',
            'slug' => '',
        ],
    ];

    #[Validate('image|max:1024')] // 1MB Max
    public $photo;

    #[Validate('required|boolean')]
    public $active = true;

    public function rules()
    {
        return RuleFactory::make([
            'translations.%title%' => 'required|string',
            'translations.%slug%' => 'required|string',
            'translations.%text%' => 'required|string',
            'translations.%excerpt%' => 'required|string',
        ]);
    }

    public function setPost(Post $post)
    {
        $this->post = $post;

        $this->translations = $post->getTranslationAttribute();

        $this->photo = $post->getImageAttribute();

        $this->active = $post->active;
    }

    public function store()
    {
        $this->validate();

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'active' => $this->active,
        ]);

        $post->fill([
            'bs' => [
                'title' => $this->translations["bs"]["title"],
                'slug' => $this->translations["bs"]["slug"],
                'text' => $this->translations["bs"]["text"],
                'excerpt' => $this->translations["bs"]["excerpt"],
                'h1' => $this->translations["bs"]["title"],
            ],
            'en' => [
                'title' => $this->translations["en"]["title"],
                'slug' => $this->translations["en"]["slug"],
                'text' => $this->translations["en"]["text"],
                'excerpt' => $this->translations["bs"]["excerpt"],
                'h1' => $this->translations["en"]["title"],
            ],
        ]);

        if (!empty($this->photo)) {
            $post->addMedia($this->photo)
                ->toMediaCollection();
        }

        $post->save();

        $this->reset();
    }

    public function update()
    {
        $this->post->update(
            $this->translations
        );
    }
}

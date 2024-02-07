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
            'h1' => '',
            'slug' => '',
        ],
        'en' => [
            'title' => '',
            'text' => '',
            'h1' => '',
            'slug' => '',
        ],
    ];

    public function rules()
    {
        return RuleFactory::make([
            'translations.%title%' => 'required|string',
            'translations.%text%' => 'required|string',
        ]);
    }

    public function setPost(Post $post)
    {
        $this->post = $post;

        $this->translations = $post->getTranslationAttribute();
    }

    public function store()
    {
        $this->validate();

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'active' => true,
        ]);

        $post->fill([
            'bs' => [
                'title' => $this->translations["bs"]["title"],
                'text' => $this->translations["bs"]["text"],
                'h1' => $this->translations["bs"]["title"],
                'slug' => Str::slug($this->translations["bs"]["title"], '-'),
            ],
            'en' => [
                'title' => $this->translations["en"]["title"],
                'text' => $this->translations["en"]["text"],
                'h1' => $this->translations["en"]["title"],
                'slug' => Str::slug($this->translations["en"]["title"], '-'),
            ],
        ]);

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

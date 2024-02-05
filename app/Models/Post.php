<?php

namespace App\Models;

use App\Models\Traits\Taggable;
use App\Models\Traits\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements TranslatableContract
{
    use HasFactory, Translatable, Taggable, SoftDeletes;

    /**
     * The attributes that are mass assignable..
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'h1', 'text', 'excerpt', 'active', 'created_at', 'updated_at', 'published_at'];

    /**
     * The attributes to be translated.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'h1', 'text', 'excerpt', 'slug'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['translations'];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

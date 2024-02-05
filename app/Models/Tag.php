<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * The attributes to be translated.
     *
     * @var array
     */
    public $translatedAttributes = ['title'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['translations'];
}

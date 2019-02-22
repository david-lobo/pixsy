<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use App\Filters\PostFilter;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'title', 'description', 'user_id'
    ];

    protected $appends = ['images'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImagesAttribute()
    {
        return $this->getMedia('gallery');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('gallery_small')
            ->height(450)
            ->performOnCollections('gallery');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new PostFilter($request))->filter($builder);
    }
}

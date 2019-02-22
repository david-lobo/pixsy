<?php

namespace App\Models;

use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{

    protected $fillable = [
        //'title', 'description',
    ];

    protected $hidden = [
        "model_type",
        "model_id",
        "collection_name",
        "size",
        "manipulations",
        "custom_properties",
        "order_column",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['urls'];

    /**
     * Get the administrator flag for the user.
     *
     * @return array
     */
    public function getUrlsAttribute()
    {
        $urls = [];
        $urls['small'] = $this->getFullUrl('gallery_small');
        $urls['large'] = $this->getFullUrl();

        return $urls;
    }
}

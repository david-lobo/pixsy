<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    protected $filters = [
        'id' => IdFilter::class,
        'all' => AllFilter::class,
        /*'content' => ContentFilter::class,
        'category' => CategoryFilter::class,
        'category_id' => CategoryIdFilter::class*/
    ];
}

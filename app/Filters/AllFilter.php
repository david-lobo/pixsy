<?php

namespace App\Filters;

class AllFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('id', $value)->orWhere('title',  'like', "%{$value}%")->orWhere('description',  'like', "%{$value}%");
    }
}

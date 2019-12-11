<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'last_updated';

    protected $fillable = [
        'id',
        'cc_id',
        'name',
        'image_url',
        'banner_url',
        'icon_url',
        'description',
        'meta_description',
        'search_words',
        'age_restricted',
        'explore_id',
        'experience_id',
        'status',
        'order',
        'parent_category',
    ];
}




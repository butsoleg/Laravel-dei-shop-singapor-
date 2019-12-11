<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    const CREATED_AT = 'registered_on';
    const UPDATED_AT = 'last_updated';

    protected $fillable = [
        'id',
        'name',
        'logo_url',
        'logo_square_url',
        'banner_url',
        'description',
        'seo_name',
        'meta_description',
        'meta_keywords',
        'story',
        'status',
        'registered_on',
        'last_updated'
    ];
}

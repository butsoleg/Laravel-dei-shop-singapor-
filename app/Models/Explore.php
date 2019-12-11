<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Explore extends Model
{
    protected $table = 'explore';
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'last_updated';

    protected $fillable = [
        'id',
        'name',
        'image_url'
    ];
}

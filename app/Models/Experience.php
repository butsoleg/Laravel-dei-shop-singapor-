<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experience';
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'last_updated';
}

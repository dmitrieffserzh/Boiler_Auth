<?php

namespace App\Models\Modules\TNParse;

use Illuminate\Database\Eloquent\Model;

class TNParseProduct extends Model
{
    protected $fillable = [
        'product',
        'name',
        'group_id'
    ];

    public $timestamps = false;
}

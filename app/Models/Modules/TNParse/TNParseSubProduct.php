<?php

namespace App\Models\Modules\TNParse;

use Illuminate\Database\Eloquent\Model;

class TNParseSubProduct extends Model
{
    protected $fillable = [
        'sub_product',
        'name',
        'product_id'
    ];

    public $timestamps = false;
}

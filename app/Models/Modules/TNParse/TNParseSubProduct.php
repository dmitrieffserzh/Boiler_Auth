<?php

namespace App\Models\Modules\TNParse;

use Illuminate\Database\Eloquent\Model;

class TNParseSubProduct extends Model
{
    protected $table = 'module__t_n_parse_sub_products';

    protected $fillable = [
        'group',
        'product',
        'sub_product',
        'name',
        'start_date',
        'end_date'
    ];

    public $timestamps = false;
}

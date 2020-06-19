<?php

namespace App\Models\Modules\TNParse;

use Illuminate\Database\Eloquent\Model;

class TNParseProduct extends Model
{
    protected $table = 'module__t_n_parse_products';

    protected $fillable = [
        'group',
        'product',
        'name',
        'start_date',
        'end_date'
    ];

    public $timestamps = false;
}

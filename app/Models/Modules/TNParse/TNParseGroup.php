<?php

namespace App\Models\Modules\TNParse;

use Illuminate\Database\Eloquent\Model;

class TNParseGroup extends Model
{
    protected $table = 'module__t_n_parse_groups';

    protected $fillable = [
        'section',
        'group',
        'name',
        'note',
        'start_date',
        'end_date'
    ];

    public $timestamps = false;
}

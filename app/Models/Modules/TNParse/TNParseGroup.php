<?php

namespace App\Models\Modules\TNParse;

use Illuminate\Database\Eloquent\Model;

class TNParseGroup extends Model
{

    protected $table = 'module__t_n_parse_group';

    protected $fillable = [
        'group',
        'name',
        'note',
        'section_id'
    ];

    public $timestamps = false;
}

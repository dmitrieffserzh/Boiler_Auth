<?php

namespace App\Models\Modules\TNParse;

use Illuminate\Database\Eloquent\Model;

class TNParseSection extends Model
{

    protected $table = 'module__t_n_parse_sections';

    protected $fillable = [
        'section',
        'name',
        'note',
        'start_date',
        'end_date'
    ];

    public $timestamps = false;
}

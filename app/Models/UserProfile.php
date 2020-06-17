<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

    protected $table = 'users_profiles';

    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'about',
        'avatar',
        'offline_at'
    ];

    protected $dates = ['offline_at'];

    public $timestamps = false;


    // RELATIONS
    public function user() {
        return $this->belongsTo(User::class);
    }
}
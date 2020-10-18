<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserCordinates extends Model
{
    protected $table = 'user_cordinates';
    protected $fillable = ['user_id', 'latitude', 'longitude'];
}

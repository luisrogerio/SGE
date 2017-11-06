<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User
 *
 * @mixin \Eloquent
 */
class User extends Model
{
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
}

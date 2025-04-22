<?php

namespace LastLoginTracker\Models;

use Illuminate\Database\Eloquent\Model;

class UserLastAccess extends Model
{
    protected $fillable = ['user_uuid', 'last_access_at'];
    public $table = 'last_user_access';

}
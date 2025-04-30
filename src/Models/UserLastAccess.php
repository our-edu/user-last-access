<?php

namespace Ouredu\UserLastAccess\Models;

use Illuminate\Database\Eloquent\Model;

class UserLastAccess extends Model
{

    protected $primaryKey = 'uuid';
    public $keyType = 'uuid';
    public $incrementing = false;
    protected $fillable = ['user_uuid', 'last_access_at'];

    public $table = 'last_user_access';

}
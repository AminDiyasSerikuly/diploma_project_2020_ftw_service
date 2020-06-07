<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    //
    public static function getMyKey()
    {
    	# code...
    	return '$2y$12$esyosghhXSh6LxcX17N/suiqeJGJq/VQ9QkbqvImtE4JMWxz7WqYS';
    }
}

<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory; 

    protected $table = 'role';
   
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UsersdataFactory::new();
    }
}

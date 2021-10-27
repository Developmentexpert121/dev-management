<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class usersdata extends Model
{
    use HasFactory;

   protected $table = 'Users_data';
    protected $fillable = ['user_id','job_title','your_department','your_organisation','your_location'];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UsersdataFactory::new();
    }
}

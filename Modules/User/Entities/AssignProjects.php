<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignProjects extends Model
{
    use HasFactory;

    protected $table = 'assign_projects';
   
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UsersdataFactory::new();
    }
}

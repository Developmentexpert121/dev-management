<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class task extends Model
{
    use HasFactory;

    protected $table = 'task';
  
    protected $fillable = ['project_name','issue_type','summary','description'];
    
    protected static function newFactory()
    {
        return \Modules\Projects\Database\factories\IssuesFactory::new();
    }
}

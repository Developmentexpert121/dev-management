<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory;

    protected $table = 'issues';
  
    protected $fillable = ['project','issue_type', 'summary' , 'description'];
    
    protected static function newFactory()
    {
        return \Modules\Projects\Database\factories\IssuesFactory::new();
    }
}

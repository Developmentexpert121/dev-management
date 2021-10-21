<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sprint_Issue extends Model
{
    use HasFactory;

    protected $table = 'sprint_issue';
  
    protected $fillable = ['id','product_id','sprint_id', 'issue_name'];
    
    protected static function newFactory()
    {
        return \Modules\Projects\Database\factories\IssuesFactory::new();
    }
}

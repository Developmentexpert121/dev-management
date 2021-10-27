<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;

    protected $table = 'category';
  
    protected $fillable = ['name','description'];
    
    protected static function newFactory()
    {
        return \Modules\Projects\Database\factories\IssuesFactory::new();
    }
}

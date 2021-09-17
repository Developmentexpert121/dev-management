<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class allsprint extends Model
{
    use HasFactory;
    protected $table = 'all_sprints';
    protected $fillable = ['sprint_name','duration','start_date','end_date','sprint_goal'];
    
    protected static function newFactory()
    {
        return \Modules\Projects\Database\factories\AllSprintFactory::new();
    }
}

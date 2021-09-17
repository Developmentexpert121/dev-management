<?php
namespace Modules\Projects\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    protected $fillable = [];
    protected static function newFactory()
    {
        return \Modules\Projects\Database\factories\ProjectFactory::new();
    }
}
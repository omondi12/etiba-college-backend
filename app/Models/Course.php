<?php
namespace App\Models;

class Course extends BaseModel
{
    protected $fillable = ['name', 'category', 'duration', 'requirements', 'description', 'is_active', 'sort_order'];
}

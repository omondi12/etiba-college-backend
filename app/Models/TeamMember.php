<?php
namespace App\Models;

class TeamMember extends BaseModel
{
    protected $fillable = ['name', 'position', 'department', 'bio', 'email', 'phone', 'photo', 'is_active', 'sort_order'];
}

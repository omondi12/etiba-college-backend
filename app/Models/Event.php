<?php
namespace App\Models;

class Event extends BaseModel
{
    protected $fillable = ['title', 'description', 'event_date', 'event_time', 'location', 'category', 'image_path', 'is_active', 'sort_order'];
}

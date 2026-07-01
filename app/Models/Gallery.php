<?php
namespace App\Models;

class Gallery extends BaseModel
{
    protected $table = 'gallery';
    protected $fillable = ['title', 'description', 'category', 'image_path', 'is_active', 'sort_order'];
}

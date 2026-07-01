<?php
namespace App\Models;

class Article extends BaseModel
{
    protected $fillable = ['title', 'category', 'author', 'excerpt', 'content', 'published_at', 'is_active', 'sort_order'];
}

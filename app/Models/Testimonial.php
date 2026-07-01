<?php
namespace App\Models;

class Testimonial extends BaseModel
{
    protected $fillable = ['name', 'role', 'quote', 'rating', 'is_active', 'sort_order'];
}

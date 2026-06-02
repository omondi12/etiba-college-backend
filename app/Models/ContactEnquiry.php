<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactEnquiry extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'is_read', 'is_archived', 'archived_at', 'deleted_by'];
    protected $casts = ['is_read' => 'boolean', 'is_archived' => 'boolean'];
}

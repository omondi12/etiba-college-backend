<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    use SoftDeletes;

    protected function setAuditFields(): void
    {
        $userId = Auth::id();

        if (!$this->exists && !$this->created_by) {
            $this->created_by = $userId;
        }

        if ($userId) {
            $this->updated_by = $userId;
        }
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->setAuditFields();
        });

        static::updating(function (self $model) {
            $model->setAuditFields();
        });

        static::deleting(function (self $model) {
            $userId = Auth::id();
            if ($userId && !$model->deleted_by) {
                $model->deleted_by = $userId;
                $model->saveQuietly();
            }
        });
    }

    public function archive(): bool
    {
        $this->is_archived = true;
        $this->archived_at = now();
        $this->archived_by = Auth::id();
        return $this->save();
    }

    public function unarchive(): bool
    {
        $this->is_archived = false;
        $this->archived_at = null;
        $this->archived_by = null;
        return $this->save();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('is_archived', false);
    }

    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }
}

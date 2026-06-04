<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
            $model->created_by = Auth::id() ?? null;
            $model->updated_by = Auth::id() ?? null;
        });

        static::updating(function (self $model) {
            $model->updated_by = Auth::id() ?? null;
        });

        static::deleting(function (self $model) {
            if (!$model->deleted_by) {
                $model->deleted_by = Auth::id() ?? null;
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

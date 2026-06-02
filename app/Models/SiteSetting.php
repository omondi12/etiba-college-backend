<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'created_by', 'updated_by'];

    public static function get(string $key, $default = null)
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function set(string $key, $value, string $group = 'general')
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
    }
}

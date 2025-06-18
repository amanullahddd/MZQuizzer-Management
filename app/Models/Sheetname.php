<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Sheetname extends Model
{
    use HasFactory;
    protected $table = 'sheetnames';
    protected $fillable = ['name', 'slug', 'spreadsheet_id', 'active'];
    protected $with = ['spreadsheet'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($sheetname) {
            // Hapus semua QuestionMedia terkait
            $sheetname->questionMedias()->delete();
        });
    }

    public function spreadsheet(): BelongsTo
    {
        return $this->belongsTo(Spreadsheet::class);
    }

    public function questionmedias(): HasMany
    {
        return $this->hasMany(Questionmedia::class, 'sheetname_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = $this->generateUniqueSlug($value);
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

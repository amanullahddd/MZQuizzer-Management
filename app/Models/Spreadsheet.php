<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Spreadsheet extends Model
{
    use HasFactory;
    protected $table = 'spreadsheets';
    protected $fillable = ['title', 'slug', 'description', 'documentId', 'apiKey', 'token', 'active'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($spreadsheet) {
            // Hapus semua QuestionMedia terkait
            $spreadsheet->sheetnames()->delete();
        });
    }

    public function sheetnames(): HasMany
    {
        return $this->hasMany(Sheetname::class, 'spreadsheet_id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->generateUniqueSlug($value);
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = Str::slug($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

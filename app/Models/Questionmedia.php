<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questionmedia extends Model
{
    use HasFactory;
    protected $table = 'questionmedias';
    protected $fillable = ['guid', 'question', 'image', 'audio', 'sheetname_id'];
    protected $with = ['sheetname'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($questionMedia) {
            // Hapus semua FileMedia terkait
            $questionMedia->filemedia()->delete();
        });
    }

    public function sheetname(): BelongsTo
    {
        return $this->belongsTo(Sheetname::class);
    }

    public function filemedias(): HasMany
    {
        return $this->hasMany(Filemedia::class);
    }
}

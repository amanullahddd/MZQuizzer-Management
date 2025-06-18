<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Filemedia extends Model
{
    use HasFactory;
    protected $table = 'filemedias';
    protected $fillable = ['name', 'type', 'active', 'questionmedia_id'];
    protected $with = ['questionmedia'];

    public function questionmedia(): BelongsTo
    {
        return $this->belongsTo(Questionmedia::class);
    }
}

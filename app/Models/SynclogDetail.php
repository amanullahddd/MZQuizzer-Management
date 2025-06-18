<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SynclogDetail extends Model
{
    use HasFactory;
    protected $table = 'synclogs_details';
    protected $fillable = ['synclog_id', 'category', 'message'];
    protected $with = ['synclog'];

    public function synclog(): BelongsTo
    {
        return $this->belongsTo(Synclog::class);
    }
}

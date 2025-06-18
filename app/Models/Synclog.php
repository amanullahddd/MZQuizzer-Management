<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Synclog extends Model
{
    use HasFactory;
    protected $table = 'synclogs';
    protected $fillable = ['process_name', 'last_synced_at', 'status', 'message'];

    public function synclogs_details(): HasMany
    {
        return $this->hasMany(SynclogDetail::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessKey extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'user_id', 'expired_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

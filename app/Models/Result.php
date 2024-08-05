<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
class Episode extends Model
{

    protected $fillable = ['title', 'number', 'duration', 'season_id'];

    // a function define que, a
        public function season() : BelongsTo
        {
            return $this->belongsTo(Season::class);
        }
}

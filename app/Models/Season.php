<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class Season extends Model
{
    // define que assim que uma temporada é criada, o usuario passa o numero dela, junto ao id de quel serie ela pertence //
    protected $fillable = ['number', 'serie_id', 'title', 'duration'];

    // aqui define que uma season pertence a uma serie (belongsTo) //
    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    // define que uma season tem varios episodios (hasMany) //
    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }
}

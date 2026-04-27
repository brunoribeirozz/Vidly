<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 * @property mixed $name
 */
class Serie extends Model
{
    // define os campos que vão ser preenchido com dados, antes passando pela validação do formRequest //
    protected $fillable = ['name', 'thumbnail', 'description'];

    // aqui é definidd que uma serie tem varias(hasMany) temporadas(seasons) //
    public function seasons() : HasMany
    {
        return $this->hasMany(Season::class);
    }
}

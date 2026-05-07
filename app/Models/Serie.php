<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 * @property mixed $name
 */
class Serie extends Model
{
    // define os campos que vão ser preenchido com dados, antes passando pela validação do formRequest //
    protected $fillable = ['name', 'thumbnail', 'description', 'number', 'user_id', 'stars', 'comment'];

    // aqui é definidd que uma serie tem varias(hasMany) temporadas(seasons) //
    public function seasons() : HasMany
    {
        return $this->hasMany(Season::class);
    }

    public function progress(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->episodes_count <= 0) return 0;

                $watched = auth()->user()->watchedEpisodes()
                    ->whereHas('season', function($query) {
                        $query->where('serie_id', $this->id);
                    })->count();

                if ($this->episodes_count <= 0) return 0;

                $percentage = ($watched / $this->episodes_count) * 100;

                return min(round($percentage), 100);
            },
        );
    }

    public function reviews(): hasMany
    {
        return $this->hasMany(Review::class);
    }
}

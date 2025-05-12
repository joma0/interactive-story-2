<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Story extends Model
{
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'location'];

    /**
     * Récupère les chapitres associés à cette histoire.
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
}

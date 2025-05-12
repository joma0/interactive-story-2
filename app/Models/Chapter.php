<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id',
        'number',
        'version',
        'text'
    ];

    /**
     * Récupère l'histoire associée à ce chapitre.
     */
    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }

    /**
     * Récupère les choix qui partent de ce chapitre.
     */
    public function originChoices(): HasMany
    {
        return $this->hasMany(Choice::class, 'origin_chapter_id');
    }

    /**
     * Récupère les choix qui mènent à ce chapitre.
     */
    public function resultChoices(): HasMany
    {
        return $this->hasMany(Choice::class, 'result_chapter_id');
    }
}

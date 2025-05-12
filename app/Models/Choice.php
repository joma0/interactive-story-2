<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Choice extends Model
{
    /**
     * Les attributs qui sont mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'origin_chapter_id',
        'result_chapter_id',
        'text'
    ];

    /**
     * Récupère le chapitre d'origine de ce choix
     */
    public function originChapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'origin_chapter_id');
    }

    /**
     * Récupère le chapitre résultant de ce choix.
     */
    public function resultChapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'result_chapter_id');
    }
}

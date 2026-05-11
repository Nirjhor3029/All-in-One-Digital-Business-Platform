<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Lecture extends Model
{
    use HasSlug;

    protected $fillable = [
        'section_id',
        'title',
        'slug',
        'content',
        'video_url',
        'video_provider',
        'duration',
        'sort_order',
        'is_free',
        'attachments',
    ];

    protected function casts(): array
    {
        return [
            'is_free' => 'boolean',
            'attachments' => 'array',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(LectureProgress::class);
    }
}

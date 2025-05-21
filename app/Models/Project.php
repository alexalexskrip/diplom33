<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'status_id',
        'name',
        'description',
    ];

    protected $attributes = [
        'status_id' => 2, // По умолчанию — «На рассмотрении»
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function sources(): BelongsToMany
    {
        return $this->belongsToMany(Source::class, 'project_source', 'project_id', 'source_id')->withTimestamps();
    }

    public function news(): HasMany
    {
        return $this->hasMany(ProjectNews::class, 'project_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    public function getFirstImageUrl(): string
    {
        $media = $this->getMedia('images')->sortBy('custom_properties.position')->first();

        return $media
            ? $media->getUrl()
            : asset('images/no_photo.jpg');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->useDisk('public');
        $this->addMediaCollection('documents')->useDisk('public');
        $this->addMediaCollection('videos')->useDisk('public');
    }
}

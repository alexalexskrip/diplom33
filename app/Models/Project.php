<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'name',
        'description',
    ];

    protected static function booted(): void
    {
        static::deleting(function ($project) {
            foreach ($project->media as $media) {
                $media->delete();
            }
        });
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function sources(): BelongsToMany
    {
        return $this->belongsToMany(Source::class, 'project_source', 'project_id', 'source_id')->withTimestamps();
    }

    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class, 'project_id');
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
        $firstMedia = $this->media->first();

        return $firstMedia && $firstMedia->file
            ? asset('storage/projectmedia/'.$firstMedia->file)
            : asset('images/no_photo.jpg');
    }
}

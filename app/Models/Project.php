<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Storage;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_status',
        'name_project',
        'discription_project',
    ];

    protected static function booted(): void
    {
        static::deleting(function ($project) {
            foreach ($project->medias as $media) {
                $media->delete();
            }
        });
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusList::class, 'id_status');
    }

    public function sourceLists(): BelongsToMany
    {
        return $this->belongsToMany(SourceList::class, 'project_source_lists', 'id_project', 'id_sourcelist')->withTimestamps();
    }

    public function medias(): HasMany
    {
        return $this->hasMany(ProjectMedia::class, 'Id_project');
    }

    public function news(): HasMany
    {
        return $this->hasMany(ProjectNews::class, 'id_project');
    }

    public function sources(): BelongsToMany
    {
        return $this->belongsToMany(SourceList::class, 'project_source_lists', 'project_id', 'source_list_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'student_projects', 'id_project', 'id_user');
    }

    public function getFirstImageUrl(): string
    {
        $firstMedia = $this->medias->first();

        return $firstMedia && $firstMedia->File_ProjectMedia
            ? asset('storage/projectmedia/' . $firstMedia->File_ProjectMedia)
            : asset('images/no_photo.jpg');
    }

}

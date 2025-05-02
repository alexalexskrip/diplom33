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
        'id_status',
        'name_project',
        'discription_project',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusList::class, 'id_status');
    }

    public function medias(): HasMany
    {
        return $this->hasMany(ProjectMedia::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(ProjectNews::class);
    }

    public function sources(): BelongsToMany
    {
        return $this->belongsToMany(SourceList::class, 'project_source_lists', 'project_id', 'source_list_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_projects', 'project_id', 'student_id');
    }
}

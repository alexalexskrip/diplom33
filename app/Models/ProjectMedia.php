<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'Id_project',
        'NumFile_ProjectMedia',
        'File_ProjectMedia',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'Id_project');
    }
}

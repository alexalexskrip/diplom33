<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectNews extends Model {

    use HasFactory;

    protected $table = 'projectnews';

    protected $fillable = [
        'id_project',
        'date_projectnews',
        'name_projectnews',
        'discription_projectnews'
    ];

    protected $casts = [
        'date_projectnews' => 'date'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

}

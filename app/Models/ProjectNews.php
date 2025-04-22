<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectNews extends Model {

    use HasFactory;

    protected $table = 'project_news';

    protected $primaryKey = 'id';

    protected $flllable = ['date', 'name', 'slug', 'description', 'text'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

}
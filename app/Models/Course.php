<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_faculty',
        'name_course',
    ];

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'id_faculty');
    }
}

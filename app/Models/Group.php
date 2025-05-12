<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_course',
        'name_group',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_group');
    }
}

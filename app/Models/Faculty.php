<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ['id_university', 'name_faculty'];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'id_university');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'id_faculty');
    }
}

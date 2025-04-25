<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_university',
        'address_university',
        'phone_university',
        'mail_university'
    ];

    public function faculties(): HasMany
    {
        return $this->hasMany(Faculty::class, 'id_university');
    }
}

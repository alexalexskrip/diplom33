<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ['id_university', 'name_faculty'];

    public function university()
    {
        return $this->belongsTo(University::class, 'id_university');
    }
}

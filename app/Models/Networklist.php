<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Networklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_networkList',
        'site_netWWorklist',
    ];
}

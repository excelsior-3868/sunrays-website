<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title', 'slug', 'age_group', 'timing', 'short_description', 
        'description', 'cover_image', 'fee'
    ];
}

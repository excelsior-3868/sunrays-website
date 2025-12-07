<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['slug', 'title', 'meta_description', 'is_published'];

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('sort_order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    // use HasFactory;
    protected $fillable = ['name', 'description'];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}

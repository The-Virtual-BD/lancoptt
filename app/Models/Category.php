<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    // protected $with = ['galleries'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Package extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['title','price','body'];



    public function options()
    {
        return $this->hasMany(PackageOption::class);
    }

}

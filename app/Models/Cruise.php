<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Cruise extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['title','body'];


    public function options()
    {
        return $this->hasMany(CruiseOption::class);
    }

}

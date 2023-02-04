<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CruiseOption extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['title','body','cruise_id'];


    public function cruise()
    {
        return $this->belongsTo(Cruise::class);
    }

}

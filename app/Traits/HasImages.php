<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasImages
{
    protected static function bootHasImages()
    {
        static::deleting(function($model) {
            foreach($model->images as $image) {
                $image->delete();
            }
        });
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

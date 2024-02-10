<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $table = 'images';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function fullUrl(): Attribute
    {
        return Attribute::get(function() {
            return asset('storage/images/' . $this->path);
        });
    }
}

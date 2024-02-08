<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $table = 'images';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}

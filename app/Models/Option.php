<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }
}

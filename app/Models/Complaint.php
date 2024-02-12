<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function complainantUser()
    {
        return $this->belongsTo(User::class, 'complainant_user_id');
    }

    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'chat_id');
    }



    // public function scopeFilterByStatus($query, $status)
    // {
    //     $query->orderBy('created_at', $status);
    // }
}

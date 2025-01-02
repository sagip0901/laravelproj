<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model {
    use HasFactory, GlobalStatus;

    public function chatBot() {
        return $this->belongsTo(ChatBot::class, 'chat_bot_id');
    }
    public function conversations() {
        return $this->hasMany(ChatMessage::class, 'chat_id');
    }

    public function lastMessage() {
        return $this->hasOne(ChatMessage::class, 'chat_id')->latestOfMany();
    }
}

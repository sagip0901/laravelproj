<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenAIModel extends Model {
    use HasFactory, GlobalStatus;

    public function scopeChatModel($query) {
        return $query->where('is_chat', Status::YES);
    }
    public function scopeTemplateModel($query) {
        return $query->where('is_chat', Status::NO);
    }
}

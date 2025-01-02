<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIImage extends Model {
    use HasFactory, GlobalStatus;

    protected $casts = [
        'images' => 'object',
    ];
}

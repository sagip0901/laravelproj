<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model {
    use HasFactory, GlobalStatus;

    protected $casts = [
        'form_data' => 'object',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function freeBadge(): Attribute {
        return new Attribute(function () {
            $html = '';
            if ($this->is_free == Status::YES) {
                $html = '<span class="badge badge--info">' . trans('Yes') . '</span>';
            } else {
                $html = '<span class="badge badge--dark">' . trans('No') . '</span>';
            }
            return $html;
        });
    }

    public function scopePaid($query) {
        return $query->where('is_free', Status::NO);
    }

    public function scopeFree($query) {
        return $query->where('is_free', Status::YES);
    }
}

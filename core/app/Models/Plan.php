<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model {
    use HasFactory, GlobalStatus;

    public function getWordLimitValueAttribute() {
        $wordLimit = $this->attributes['word_limit'];
        if ($wordLimit == -1) {
            $wordLimit = 'Unlimited';
        }
        return $wordLimit;
    }
    public function getImageLimitValueAttribute() {
        $imageLimit = $this->attributes['image_limit'];
        if ($imageLimit == -1) {
            $imageLimit = 'Unlimited';
        }
        return $imageLimit;
    }
    public function getMinuteLimitValueAttribute() {
        $minuteLimit = $this->attributes['minute_limit'];
        if ($minuteLimit == -1) {
            $minuteLimit = 'Unlimited';
        }
        return $minuteLimit;
    }

    public function getDurationAttribute() {
        $type     = $this->attributes['type'];
        $duration = null;
        if ($type == Status::YEARLY_PLAN) {
            $duration = now()->addDays(365);
        } else {
            $duration = now()->addDays(30);
        }
        return $duration;
    }

    public function getDiscountAttribute() {
        $discountType = $this->attributes['discount_type'];
        $amount       = null;
        if ($discountType == Status::FIXED_DISCOUNT) {
            $amount = getAmount($this->attributes['discount_amount']) . ' ' . gs('cur_text');
        } else {
            $amount = getAmount($this->attributes['discount_amount']) . ' ' . '%';
        }
        return $amount;
    }

    public function planTypeBadge(): Attribute {
        return new Attribute(
            get: fn() => $this->planTypeData(),
        );
    }

    public function planTypeData() {
        $html = '';
        if ($this->type == Status::YEARLY_PLAN) {
            $html = trans('Yearly');
        } else {
            $html = trans('Monthly');
        }
        return $html;
    }
}

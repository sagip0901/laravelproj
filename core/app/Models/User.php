<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\UserNotify;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, UserNotify;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ver_code', 'balance', 'kyc_data',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'kyc_data'          => 'object',
        'access'            => 'object',
        'ver_code_send_at'  => 'datetime',
    ];

    public function loginLogs() {
        return $this->hasMany(UserLogin::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class)->orderBy('id', 'desc');
    }

    public function deposits() {
        return $this->hasMany(Deposit::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function withdrawals() {
        return $this->hasMany(Withdrawal::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function tickets() {
        return $this->hasMany(SupportTicket::class);
    }

    public function referrer() {
        return $this->belongsTo(self::class, 'ref_by');
    }

    public function referrals() {
        return $this->hasMany(self::class, 'ref_by');
    }

    public function favoriteTemplate() {
        return $this->hasMany(Favorite::class);
    }
    public function getFavoriteTemplateIdsAttribute() {
        return $this->favoriteTemplate->pluck('template_id')->toArray();
    }

    public function fullname(): Attribute {
        return new Attribute(
            get: fn() => $this->firstname . ' ' . $this->lastname,
        );
    }

    public function mobileNumber(): Attribute {
        return new Attribute(
            get: fn() => $this->dial_code . $this->mobile,
        );
    }

    public function balanceLimit(): Attribute {
        return new Attribute(function () {
            $limit = [
                'plan'         => false,
                'word_limit'   => 0,
                'image_limit'  => 0,
                'minute_limit' => 0,
            ];
            if ($this->plan_id && $this->expired_date > now()) {
                $limit = [
                    'plan'         => true,
                    'word_limit'   => getAmount($this->access->word_limit, 0),
                    'image_limit'  => getAmount($this->access->image_limit, 0),
                    'minute_limit' => getAmount($this->access->minute_limit, 0),
                ];
            }
            return $limit;
        });
    }

    // SCOPES
    public function scopeActive($query) {
        return $query->where('status', Status::USER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED);
    }

    public function scopeBanned($query) {
        return $query->where('status', Status::USER_BAN);
    }

    public function scopeEmailUnverified($query) {
        return $query->where('ev', Status::UNVERIFIED);
    }

    public function scopeMobileUnverified($query) {
        return $query->where('sv', Status::UNVERIFIED);
    }

    public function scopeKycUnverified($query) {
        return $query->where('kv', Status::KYC_UNVERIFIED);
    }

    public function scopeKycPending($query) {
        return $query->where('kv', Status::KYC_PENDING);
    }

    public function scopeEmailVerified($query) {
        return $query->where('ev', Status::VERIFIED);
    }

    public function scopeMobileVerified($query) {
        return $query->where('sv', Status::VERIFIED);
    }

    public function scopeWithBalance($query) {
        return $query->where('balance', '>', 0);
    }

    public function deviceTokens() {
        return $this->hasMany(DeviceToken::class);
    }

}

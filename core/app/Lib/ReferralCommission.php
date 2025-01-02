<?php

namespace App\Lib;

use App\Constants\Status;
use App\Models\Extension;
use App\Models\Transaction;

class ReferralCommission
{
    public static function subscriptionCommission($user, $amount, $trx)
    {
        $referral = $user->referrer;

        $commission = $amount * gs('subscription_bonus') / 100;
        $referral->balance += $commission;
        $referral->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $referral->id;
        $transaction->amount       = $commission;
        $transaction->post_balance = $referral->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Subscription referral bonus from ' . $user->username;
        $transaction->trx          = $trx;
        $transaction->remark       = 'subscription_bonus';
        $transaction->save();

        notify($referral, "SUBSCRIPTION_COMMISSION", [
            'amount' => $commission,
            'trx' => $trx,
            'post_balance' => $referral->balance
        ]);
    }

    public static function registerCommission($user)
    {
        $referral = $user->referrer;
        $referral->balance += gs('register_bonus');
        $referral->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $referral->id;
        $transaction->amount       = gs('register_bonus');
        $transaction->post_balance = $referral->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Got a registered referral bonus from ' . $user->username;
        $transaction->trx          = getTrx();
        $transaction->remark       = 'register_commission';
        $transaction->save();

        notify($referral, 'REGISTER_COMMISSION', [
            'username' => $user->username,
            'amount'   => gs('register_bonus'),
            'trx'      => $transaction->trx,
        ]);
    }
}

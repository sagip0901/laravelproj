<?php

namespace App\Http\Controllers\Gateway;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Lib\ReferralCommission;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller {
    public function deposit() {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->with('method')->orderby('name')->get();
        $pageTitle = 'Payment Methods';

        $subscriptionId = session()->get('subscription_id');
        if (!$subscriptionId) {
            $notify[] = ['error', 'Oops! Session invalid'];
            return redirect()->route('user.home')->withNotify($notify);
        }

        $subscription = Subscription::inactive()->where('id', $subscriptionId)->first();
        if (!$subscription) {
            $notify[] = ['error', 'Oops! Subscription not found'];
            return redirect()->route('user.home')->withNotify($notify);
        }

        $plan   = $subscription->plan;
        $amount = $plan->price;
        if ($plan->is_discount) {
            if ($plan->discount_type == Status::FIXED_DISCOUNT) {
                $amount -= $plan->discount_amount;
            } else {
                $amount = $amount - ($amount * $plan->discount_amount / 100);
            }
        }
        return view('Template::user.payment.deposit', compact('gatewayCurrency', 'pageTitle', 'amount'));
    }

    public function depositInsert(Request $request) {
        $request->validate([
            'amount'   => 'required|numeric|gt:0',
            'gateway'  => 'required',
            'currency' => 'required',
        ]);

        $subscriptionId = session()->get('subscription_id');
        if (!$subscriptionId) {
            $notify[] = ['error', 'Oops! Session invalid'];
            return redirect()->route('user.home')->withNotify($notify);
        }
        $subscription = Subscription::inactive()->where('id', $subscriptionId)->first();
        if (!$subscription) {
            $notify[] = ['error', 'Oops! Subscription not found'];
            return redirect()->route('user.home')->withNotify($notify);
        }

        $user = auth()->user();
        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('method_code', $request->gateway)->where('currency', $request->currency)->first();
        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        $plan           = $subscription->plan;
        $amount         = $plan->price;
        $discountAmount = 0;

        if ($plan->is_discount) {
            if ($plan->discount_type == Status::FIXED_DISCOUNT) {
                $discountAmount = $plan->discount_amount;
                $amount -= $discountAmount;
            } else {
                $discountAmount = $amount * $plan->discount_amount / 100;
                $amount         = $amount - $discountAmount;
            }
        }

        if ($gate->min_amount > $amount || $gate->max_amount < $amount) {
            $notify[] = ['error', 'Please follow deposit limit'];
            return back()->withNotify($notify);
        }

        $charge       = $gate->fixed_charge + ($amount * $gate->percent_charge / 100);
        $payable      = $amount + $charge;
        $final_amount = $payable * $gate->rate;

        $data                  = new Deposit();
        $data->subscription_id = $subscription->id;
        $data->user_id         = $user->id;
        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount          = $amount;
        $data->charge          = $charge;
        $data->rate            = $gate->rate;
        $data->final_amount    = $final_amount;
        $data->discount        = $discountAmount;
        $data->btc_amount      = 0;
        $data->btc_wallet      = "";
        $data->trx             = getTrx();
        $data->success_url     = urlPath('user.deposit.history');
        $data->failed_url      = urlPath('user.deposit.history');
        $data->save();
        session()->put('Track', $data->trx);
        return to_route('user.deposit.confirm');
    }

    public function appDepositConfirm($hash) {
        try {
            $id = decrypt($hash);
        } catch (\Exception $ex) {
            abort(404);
        }
        $data = Deposit::where('id', $id)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->firstOrFail();
        $user = User::findOrFail($data->user_id);
        auth()->login($user);
        session()->put('Track', $data->trx);
        return to_route('user.deposit.confirm');
    }

    public function depositConfirm() {
        $track   = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            return to_route('user.deposit.manual.confirm');
        }

        $dirName = $deposit->gateway->alias;
        $new     = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);

        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return back()->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view("Template::$data->view", compact('data', 'pageTitle', 'deposit'));
    }

    public static function userDataUpdate($deposit, $isManual = null) {
        if ($deposit->status == Status::PAYMENT_INITIATE || $deposit->status == Status::PAYMENT_PENDING) {
            $deposit->status = Status::PAYMENT_SUCCESS;
            $deposit->save();

            $subscription         = $deposit->subscription;
            $subscription->status = Status::ENABLE;
            $subscription->save();

            $plan = $subscription->plan;

            $userAccess = [
                'ai_template'      => $plan->ai_template,
                'ai_image'         => $plan->ai_image,
                'ai_chat'          => $plan->ai_chat,
                'ai_code'          => $plan->ai_code,
                'ai_transcript'    => $plan->ai_transcript,
                'ai_voiceover'     => $plan->ai_voiceover,
                'premium_template' => $plan->premium_template,
                'premium_chat'     => $plan->premium_chat,
                'word_limit'       => $plan->word_limit,
                'image_limit'      => $plan->image_limit,
                'minute_limit'     => $plan->minute_limit,
                'character_limit'  => $plan->character_limit,
                'free_plan'        => $plan->free_plan,
            ];

            $user               = User::find($deposit->user_id);
            $user->plan_id      = $subscription->plan_id;
            $user->expired_date = $subscription->expired_date;
            $user->access       = $userAccess;
            $user->save();

            $methodName = $deposit->methodName();

            $transaction               = new Transaction();
            $transaction->user_id      = $deposit->user_id;
            $transaction->amount       = $deposit->amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge       = $deposit->charge;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Payment Via ' . $methodName;
            $transaction->trx          = $deposit->trx;
            $transaction->remark       = 'payment';
            $transaction->save();

            if (!$isManual) {
                $adminNotification            = new AdminNotification();
                $adminNotification->user_id   = $user->id;
                $adminNotification->title     = 'Payment successful via ' . $methodName;
                $adminNotification->click_url = urlPath('admin.deposit.successful');
                $adminNotification->save();
            }

            notify($user, 'SUBSCRIBE_PLAN', [
                'username'   => $user->username,
                'plan'       => @$subscription->plan->name,
                'price'      => showAmount(@$subscription->plan->price),
                'expired_at' => @$subscription->plan->duration,
            ]);

            if (gs('subscription_commission') && $user->ref_by) {
                ReferralCommission::subscriptionCommission($user, $deposit->amount, $transaction->trx);
            }

        }
    }

    public function manualDepositConfirm() {
        $track = session()->get('Track');
        $data  = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        abort_if(!$data, 404);
        if ($data->method_code > 999) {
            $pageTitle = 'Confirm Deposit';
            $method    = $data->gatewayCurrency();
            $gateway   = $method->method;
            return view('Template::user.payment.manual', compact('data', 'pageTitle', 'method', 'gateway'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request) {
        $track = session()->get('Track');
        $data  = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        abort_if(!$data, 404);
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway         = $gatewayCurrency->method;
        $formData        = $gateway->form->form_data;

        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);

        $data->detail = $userData;
        $data->status = Status::PAYMENT_PENDING;
        $data->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $data->user->id;
        $adminNotification->title     = 'Deposit request from ' . $data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details', $data->id);
        $adminNotification->save();

        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name'     => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount'   => showAmount($data->final_amount, currencyFormat: false),
            'amount'          => showAmount($data->amount, currencyFormat: false),
            'charge'          => showAmount($data->charge, currencyFormat: false),
            'rate'            => showAmount($data->rate, currencyFormat: false),
            'trx'             => $data->trx,
        ]);

        $notify[] = ['success', 'You have deposit request has been taken'];
        return to_route('user.deposit.history')->withNotify($notify);
    }

}

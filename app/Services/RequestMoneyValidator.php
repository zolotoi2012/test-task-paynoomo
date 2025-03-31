<?php

namespace App\Services;

use App\Dto\Request;
use App\Dto\Transaction;

class RequestMoneyValidator implements RequestMoneyInterface
{
    public function validate(Request $request, Transaction $transaction, string $deviation = "0"): bool
    {
        if (strtolower($request->currency) != strtolower($transaction->currency)) {
            return false;
        }

        if (env('APP_DEVIATION') != null) {
            $deviation = env('APP_DEVIATION');
        }

        $reqAmount = $request->amount - $request->amount * $deviation;

        $scale = explode('.', $reqAmount);

        if (count($scale) < 2) {
            return $transaction->amount == $reqAmount;
        }

        return bccomp($transaction->amount, (string) $reqAmount, strlen($scale[1])) == 0;
    }
}




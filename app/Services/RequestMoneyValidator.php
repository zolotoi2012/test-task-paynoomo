<?php

namespace App\Services;

use App\Dto\Request;
use App\Dto\Transaction;

class RequestMoneyValidator implements RequestMoneyInterface
{
    private const SCALE = 2;

    public function __construct(
        private Config $config
    ){}

    public function validate(Request $request, Transaction $transaction, string $deviation = "0"): bool
    {
        if (strtolower($request->currency) != strtolower($transaction->currency)) {
            return false;
        }

        $this->config->setDeviation($deviation);

        $deviationRequest = bcsub($request->amount, bcmul($request->amount, $this->config->getDeviation(), self::SCALE), self::SCALE);

        $scale = explode('.', $deviationRequest);

        if (count($scale) < self::SCALE) {
            return $transaction->amount == $deviationRequest;
        }

        return bccomp($transaction->amount, $deviationRequest, strlen($scale[1])) == 0;
    }
}




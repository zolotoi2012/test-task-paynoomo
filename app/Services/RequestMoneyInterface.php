<?php

namespace App\Services;

use App\Dto\Request;
use App\Dto\Transaction;

interface RequestMoneyInterface
{
    public function validate(Request $request, Transaction $transaction): bool;
}

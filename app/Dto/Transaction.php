<?php

namespace App\Dto;

class Transaction
{
    public function __construct(
        public string $amount,
        public string $currency,
    ) {}
}

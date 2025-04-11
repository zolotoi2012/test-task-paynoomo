<?php

namespace App\Dto;

class Request
{
    public function __construct(
        public string $amount,
        public string $currency,
    ) {}
}

<?php

namespace App\Services;

class Config
{
    public function __construct(
        public string $deviation
    ){}

    public function setDeviation(string $deviation): void
    {
        env('APP_DEVIATION') != null ? env('APP_DEVIATION') : $this->deviation = $deviation;
    }

    public function getDeviation(): ?string
    {
        return $this->deviation;
    }
}

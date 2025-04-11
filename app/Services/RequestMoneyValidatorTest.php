<?php

namespace App\Services;

use App\Dto\Request;
use App\Dto\Transaction;
use PHPUnit\Framework\TestCase;

class RequestMoneyValidatorTest extends TestCase
{
    public function testRequestMoneyValidator()
    {
        $testsCases = [
            [
                'name' => 'Success #1',
                'transaction' => new Transaction('90', 'USD'),
                'request' => new Request('100','USD'),
                'deviation' => '0.1',
                'wantResult' => true,
            ],
            [
                'name' => 'Success #2',
                'transaction' => new Transaction('97.54', 'USD'),
                'request' => new Request('100','USD'),
                'deviation' => '0.01',
                'wantResult' => false,
            ],
            [
                'name' => 'Success #3',
                'transaction' => new Transaction('80', 'USD'),
                'request' => new Request('100','USD'),
                'deviation' => '0.2',
                'wantResult' => true,
            ],
            [
                'name' => 'Success #4',
                'transaction' => new Transaction('80.1', 'USD'),
                'request' => new Request('89','USD'),
                'deviation' => '0.1',
                'wantResult' => true,
            ],
            [
                'name' => 'Success #5',
                'transaction' => new Transaction('90', 'EUR'),
                'request' => new Request('100','USD'),
                'deviation' => '0.01',
                'wantResult' => false,
            ],
        ];

        foreach ($testsCases as $tests) {
            $config = new Config($tests['deviation']);
            $requestMoneyValidator = new RequestMoneyValidator($config);
            $this->assertEquals($tests['wantResult'], $requestMoneyValidator->validate($tests['request'], $tests['transaction'], $tests['deviation']));
        }
    }
}

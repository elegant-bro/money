<?php

declare(strict_types=1);

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

use function ltrim;
use function strpos;

final class Minus implements Money
{
    /**
     * @var Money
     */
    private $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        if (0 === strpos($amount = $this->money->amount(), '-')) {
            return ltrim($amount, '-');
        }
        return "-$amount";
    }

    /**
     * @inheritDoc
     */
    public function currency(): Currency
    {
        return $this->money->currency();
    }

    /**
     * @inheritDoc
     */
    public function scale(): int
    {
        return $this->money->scale();
    }
}

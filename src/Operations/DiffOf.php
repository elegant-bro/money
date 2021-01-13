<?php

declare(strict_types=1);

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

final class DiffOf implements Money
{
    /**
     * @var SumOf
     */
    private $money;

    public function __construct(Money $x, Money $y)
    {
        $this->money = new SumOf($x, new Minus($y));
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        return $this->money->amount();
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

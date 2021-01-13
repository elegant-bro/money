<?php

declare(strict_types=1);

namespace ElegantBro\Money\Ensure;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use LogicException;

use function bccomp;

final class Positive implements Money
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
        if (bccomp($a = $this->money->amount(), '0', $this->money->scale()) < 0) {
            throw new LogicException("Amount must be positive but is $a");
        }

        return $a;
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

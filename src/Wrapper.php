<?php

declare(strict_types=1);


namespace ElegantBro\Money;

abstract class Wrapper implements Money
{
    /**
     * @var Money
     */
    private $money;

    final protected function is(Money $money): void
    {
        $this->money = $money;
    }

    final public function amount(): string
    {
        return $this->money->amount();
    }

    final public function currency(): Currency
    {
        return $this->money->currency();
    }

    final public function scale(): int
    {
        return $this->money->scale();
    }
}

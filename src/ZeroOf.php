<?php

declare(strict_types=1);


namespace ElegantBro\Money;

final class ZeroOf implements Money
{
    /**
     * @var Money
     */
    private $money;


    public function __construct(Money $money)
    {
        $this->money = new SameAs($money, '0');
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

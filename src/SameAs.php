<?php

declare(strict_types=1);


namespace ElegantBro\Money;

final class SameAs implements Money
{
    /**
     * @var Money
     */
    private $money;

    /**
     * @var string
     */
    private $amount;

    public function __construct(Money $money, string $amount)
    {
        $this->money = $money;
        $this->amount = $amount;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        return $this->amount;
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

<?php

declare(strict_types=1);

namespace ElegantBro\Money;

final class FnMoney implements Money
{
    /**
     * @var callable(): string
     */
    private $amountFn;

    /**
     * @var callable(): Currency
     */
    private $currencyFn;

    /**
     * @var callable(): int
     */
    private $scaleFn;

    /**
     * @param callable(): string $amountFn
     * @param callable(): Currency $currencyFn
     * @param callable(): int $scaleFn
     */
    public function __construct(callable $amountFn, callable $currencyFn, callable $scaleFn)
    {
        $this->amountFn = $amountFn;
        $this->currencyFn = $currencyFn;
        $this->scaleFn = $scaleFn;
    }

    public function amount(): string
    {
        return ($this->amountFn)();
    }

    public function currency(): Currency
    {
        return ($this->currencyFn)();
    }

    public function scale(): int
    {
        return ($this->scaleFn)();
    }
}

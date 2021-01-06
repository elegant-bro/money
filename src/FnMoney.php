<?php

declare(strict_types=1);

namespace ElegantBro\Money;

use function call_user_func;

final class FnMoney implements Money
{
    /**
     * @var callable
     */
    private $amountFn;

    /**
     * @var callable
     */
    private $currencyFn;

    /**
     * @var callable
     */
    private $scaleFn;

    /**
     * @param callable $amountFn function(): string
     * @param callable $currencyFn function(): Currency
     * @param callable $scaleFn function(): int
     */
    public function __construct(callable $amountFn, callable $currencyFn, callable $scaleFn)
    {
        $this->amountFn = $amountFn;
        $this->currencyFn = $currencyFn;
        $this->scaleFn = $scaleFn;
    }

    public function amount(): string
    {
        return call_user_func($this->amountFn);
    }

    public function currency(): Currency
    {
        return call_user_func($this->currencyFn);
    }

    public function scale(): int
    {
        return call_user_func($this->scaleFn);
    }
}

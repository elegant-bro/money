<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Ensure\EqualCurrencies;
use ElegantBro\Money\Money;
use Exception;
use function bcadd;

final class SumOf implements Money
{
    /**
     * @var Money
     */
    private $x;

    /**
     * @var Money
     */
    private $y;

    public function __construct(Money $x, Money $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function amount(): string
    {
        (new EqualCurrencies(
            $this->x->currency(),
            $this->y->currency())
        )->asString();
        return bcadd($this->x->amount(), $this->y->amount(), 4);
    }

    public function currency(): Currency
    {
        return new EqualCurrencies(
            $this->x->currency(),
            $this->y->currency()
        );
    }
}
<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

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
    private $origin;

    public function __construct(Money $origin)
    {
        $this->origin = $origin;
    }

    public function amount(): string
    {
        if (0 === strpos($amount = $this->origin->amount(), '-')) {
            return ltrim($amount, '-');
        }
        return "-$amount";
    }

    public function currency(): Currency
    {
        return $this->origin->currency();
    }
}

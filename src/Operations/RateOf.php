<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Operations;

use ElegantBro\Interfaces\Numeric;
use ElegantBro\Money\Ensure\EqualCurrencies;
use ElegantBro\Money\Money;
use Exception;
use function bcdiv;

final class RateOf implements Numeric
{
    /**
     * @var Money
     */
    private $base;

    /**
     * @var Money
     */
    private $minor;

    public function __construct(Money $base, Money $minor)
    {
        $this->base = $base;
        $this->minor = $minor;
    }

    /**
     * @return string Number
     * @throws Exception
     */
    public function asNumber(): string
    {
        (new EqualCurrencies(
            $this->base->currency(),
            $this->minor->currency()
        ))->asString();

        return bcdiv($this->base->amount(), $this->minor->amount(), 8);
    }
}

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

    /**
     * @var int
     */
    private $scale;

    public function __construct(Money $base, Money $minor, int $scale)
    {
        $this->base = $base;
        $this->minor = $minor;
        $this->scale = $scale;
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

        return bcdiv($this->base->amount(), $this->minor->amount(), $this->scale);
    }
}

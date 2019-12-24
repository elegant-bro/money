<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use Exception;

final class DiffOf implements Money
{
    /**
     * @var SumOf
     */
    private $origin;

    public function __construct(Money $x, Money $y)
    {
        $this->origin = new SumOf(
            $x,
            new Minus($y)
        );
    }

    /**
     * @return string
     * @throws Exception
     */
    public function amount(): string
    {
        return $this->origin->amount();
    }

    public function currency(): Currency
    {
        return $this->origin->currency();
    }
}

<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Operations;

use function bcmul;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

final class Negative implements Money
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
        return bcmul(-1, $this->origin->amount(), 4);
    }

    public function currency(): Currency
    {
        return $this->origin->currency();
    }
}
<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Stub;

use ElegantBro\Money\Currencies\RUB;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

final class ThreeRubles implements Money
{
    public function amount(): string
    {
        return '3';
    }

    public function currency(): Currency
    {
        return new RUB();
    }

    public function scale(): int
    {
        return 2;
    }
}

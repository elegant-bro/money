<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Stub;

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

final class TwoDollars implements Money
{
    public function amount(): string
    {
        return '2';
    }

    public function currency(): Currency
    {
        return new USD();
    }

    public function scale(): int
    {
        return 2;
    }
}

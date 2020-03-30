<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Stub;

use ElegantBro\Money\Currencies\BYN;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

final class ZeroBelarusRuble implements Money
{
    public function amount(): string
    {
        return '0';
    }

    public function currency(): Currency
    {
        return new BYN();
    }

    public function scale(): int
    {
        return 2;
    }
}

<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Currencies;

use ElegantBro\Money\Currency;

final class RUB implements Currency
{
    public function asString(): string
    {
        return 'RUB';
    }
}

<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money;

use ElegantBro\Money\Ensure\IsoCurrency;

function money($amount, string $currency): Money
{
    return new JustMoney(
        (string)$amount,
        new IsoCurrency($currency)
    );
}
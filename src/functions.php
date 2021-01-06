<?php

declare(strict_types=1);

namespace ElegantBro\Money;

use ElegantBro\Money\Ensure\IsoCurrency;

function money(string $amount, string $currency, int $scale): Money
{
    return new JustMoney(
        $amount,
        new IsoCurrency($currency),
        $scale
    );
}

<?php

declare(strict_types=1);

namespace ElegantBro\Money\Currencies;

use ElegantBro\Money\Currency;

final class RUB implements Currency
{
    public function asString(): string
    {
        return 'RUB';
    }
}

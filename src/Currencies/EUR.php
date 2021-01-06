<?php

declare(strict_types=1);

namespace ElegantBro\Money\Currencies;

use ElegantBro\Money\Currency;

final class EUR implements Currency
{
    public function asString(): string
    {
        return 'EUR';
    }
}

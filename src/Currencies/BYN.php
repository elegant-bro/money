<?php

declare(strict_types=1);

namespace ElegantBro\Money\Currencies;

use ElegantBro\Money\Currency;

final class BYN implements Currency
{
    public function asString(): string
    {
        return 'BYN';
    }
}

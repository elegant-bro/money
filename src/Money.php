<?php

declare(strict_types=1);

namespace ElegantBro\Money;

use Exception;

interface Money
{
    /**
     * @return string
     * @throws Exception
     */
    public function amount(): string;

    /**
     * @return Currency
     * @throws Exception
     */
    public function currency(): Currency;

    /**
     * @return int
     * @throws Exception
     */
    public function scale(): int;
}

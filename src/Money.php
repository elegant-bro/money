<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

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
}

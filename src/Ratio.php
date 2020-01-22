<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money;

use ElegantBro\Interfaces\Numeric;
use Exception;

interface Ratio
{
    /**
     * @param Currency $base
     * @param Currency $minor
     * @return Numeric
     * @throws Exception
     */
    public function of(Currency $base, Currency $minor): Numeric;
}

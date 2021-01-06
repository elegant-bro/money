<?php

declare(strict_types=1);

namespace ElegantBro\Money;

use ElegantBro\Interfaces\Numeric;
use Exception;

interface Ratio
{
    /**
     * @param Currency $base
     * @param Currency $minor
     *
     * @throws Exception
     */
    public function of(Currency $base, Currency $minor): Numeric;
}

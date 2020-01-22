<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Stub;

use ElegantBro\Interfaces\Numeric;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Ratio;
use Exception;

final class StubRatio implements Ratio
{
    /**
     * @var string
     */
    private $ratio;

    public function __construct(string $ratio)
    {
        $this->ratio = $ratio;
    }

    /**
     * @param Currency $base
     * @param Currency $minor
     * @return Numeric
     * @throws Exception
     */
    public function of(Currency $base, Currency $minor): Numeric
    {
        return new JustNumeric($this->ratio);
    }
}

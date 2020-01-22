<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Stub;

use ElegantBro\Interfaces\Numeric;
use Exception;

final class JustNumeric implements Numeric
{
    /**
     * @var string
     */
    private $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * @return string Number
     * @throws Exception
     */
    public function asNumber(): string
    {
        return $this->number;
    }
}

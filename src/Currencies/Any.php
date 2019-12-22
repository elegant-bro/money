<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Currencies;

use ElegantBro\Money\Currency;
use Exception;

final class Any implements Currency
{
    /**
     * @var string
     */
    private $iso;

    public function __construct(string $iso)
    {
        $this->iso = $iso;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function asString(): string
    {
        return $this->iso;
    }
}
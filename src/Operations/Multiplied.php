<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use InvalidArgumentException;
use function bcmul;
use function is_numeric;

final class Multiplied implements Money
{
    /**
     * @var Money
     */
    private $money;

    /**
     * @var string
     */
    private $multiplier;

    /**
     * @var int
     */
    private $scale;

    public function __construct(Money $money, string $multiplier, int $scale)
    {
        if (!is_numeric($multiplier)) {
            throw new InvalidArgumentException("Multiplier must be numeric, $multiplier given");
        }
        $this->money = $money;
        $this->multiplier = $multiplier;
        $this->scale = $scale;
    }

    public function amount(): string
    {
        return bcmul($this->money->amount(), $this->multiplier, $this->scale);
    }

    public function currency(): Currency
    {
        return $this->money->currency();
    }
}

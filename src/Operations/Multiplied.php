<?php declare(strict_types=1);
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

    public function __construct(Money $money, $multiplier)
    {
        if (!is_numeric($multiplier)) {
            throw new InvalidArgumentException("Multiplier must be numeric, $multiplier given");
        }
        $this->money = $money;
        $this->multiplier = (string)$multiplier;
    }

    public function amount(): string
    {
        return bcmul($this->money->amount(), $this->multiplier, 4);
    }

    public function currency(): Currency
    {
        return $this->money->currency();
    }
}
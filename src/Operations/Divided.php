<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Operations;


use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use InvalidArgumentException;
use function bccomp;
use function bcdiv;
use function is_numeric;

final class Divided implements Money
{
    /**
     * @var Money
     */
    private $money;

    /**
     * @var string
     */
    private $denominator;

    public function __construct(Money $money, $denominator)
    {
        if (!is_numeric($denominator)) {
            throw new InvalidArgumentException("Denominator must be numeric, $denominator given");
        }
        $this->denominator = (string)$denominator;

        if (bccomp($this->denominator, '0') === 0) {
            throw new InvalidArgumentException('Denominator must not be zero');
        }

        $this->money = $money;
    }

    public function amount(): string
    {
        return bcdiv($this->money->amount(), $this->denominator, 4);
    }

    public function currency(): Currency
    {
        return $this->money->currency();
    }
}
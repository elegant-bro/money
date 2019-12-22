<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Ensure;


use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use LogicException;
use function bccomp;

final class Positive implements Money
{
    /**
     * @var Money
     */
    private $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function amount(): string
    {
        if (bccomp($a = $this->money->amount(), '0') < 0) {
            throw new LogicException("Amount must be positive but is $a");
        }

        return $a;
    }

    public function currency(): Currency
    {
        return $this->money->currency();
    }
}
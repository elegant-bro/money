<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Ensure\EqualCurrencies;
use ElegantBro\Money\Money;
use Exception;
use function array_map;
use function array_reduce;
use function bcadd;

final class SumOf implements Money
{
    /**
     * @var Money[]
     */
    private $monies;

    /**
     * @var EqualCurrencies
     */
    private $currency;

    /**
     * @var int
     */
    private $scale;

    public static function two(Money $x, Money $y, int $scale): SumOf
    {
        return new SumOf([$x, $y], $scale);
    }

    public function __construct(array $monies, int $scale)
    {
        $this->monies = $monies;
        $this->currency = new EqualCurrencies(
            ...array_map(
                static function (Money $m) {
                    return $m->currency();
                },
                $this->monies
            )
        );
        $this->scale = $scale;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function amount(): string
    {
        $this->currency->asString();
        return (string)array_reduce(
            $this->monies,
            function (string $sum, Money $m) {
                return bcadd($sum, $m->amount(), $this->scale);
            },
            '0'
        );
    }

    public function currency(): Currency
    {
        return $this->currency;
    }
}

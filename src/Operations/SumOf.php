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

    public function __construct(Money ...$monies)
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
            static function (string $sum, Money $m) {
                return bcadd($sum, $m->amount(), 4);
            },
            '0'
        );
    }

    public function currency(): Currency
    {
        return $this->currency;
    }
}

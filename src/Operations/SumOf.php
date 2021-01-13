<?php

declare(strict_types=1);

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Ensure\EqualCurrencies;
use ElegantBro\Money\Ensure\EqualScales;
use ElegantBro\Money\Money;

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
     * @var EqualScales
     */
    private $scale;

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
        $this->scale = new EqualScales(
            ...array_map(
                static function (Money $m) {
                    return $m->scale();
                },
                $this->monies
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        $this->currency->validate();
        $scale = $this->scale->asInt();

        return (string)array_reduce(
            $this->monies,
            static function (string $sum, Money $m) use ($scale) {
                return bcadd($sum, $m->amount(), $scale);
            },
            '0'
        );
    }

    /**
     * @inheritDoc
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * @inheritDoc
     */
    public function scale(): int
    {
        return $this->scale->asInt();
    }
}

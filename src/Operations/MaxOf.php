<?php

declare(strict_types=1);


namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currencies\LotFirstCurrency;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Ensure\EqualCurrenciesLot;
use ElegantBro\Money\Lot;
use ElegantBro\Money\Money;
use LogicException;
use function bccomp;

final class MaxOf implements Money
{
    /**
     * @var Lot
     */
    private $lot;

    /**
     * @var int
     */
    private $scale;

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(Lot $lot, int $scale)
    {
        $this->lot = new EqualCurrenciesLot($lot);
        $this->currency = new LotFirstCurrency($lot);
        $this->scale = $scale;
    }

    public function amount(): string
    {
        $max = '';
        foreach ($this->lot->asIterator() as $money) {
            if ('' === $max) {
                $max = $money->amount();
            } else {
                $max = bccomp($max, $current = $money->amount(), $this->scale) < 0 ? $current : $max;
            }
        }

        if ('' === $max) {
            throw new LogicException('Can not find maximum of empty lot');
        }

        return $max;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function scale(): int
    {
        return $this->scale;
    }
}

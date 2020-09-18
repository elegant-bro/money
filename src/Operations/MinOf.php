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

final class MinOf implements Money
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
        $min = '';
        foreach ($this->lot->asIterator() as $money) {
            if ('' === $min) {
                $min = $money->amount();
            } else {
                $min = bccomp($min, $current = $money->amount(), $this->scale) > 0 ? $current : $min;
            }
        }

        if ('' === $min) {
            throw new LogicException('Can not find minimum of empty lot');
        }

        return $min;
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

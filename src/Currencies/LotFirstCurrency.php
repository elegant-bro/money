<?php

declare(strict_types=1);

namespace ElegantBro\Money\Currencies;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Lot;
use ElegantBro\Money\Money;
use LogicException;

final class LotFirstCurrency implements Currency
{
    /**
     * @var Lot
     */
    private $lot;

    public function __construct(Lot $lot)
    {
        $this->lot = $lot;
    }

    public function asString(): string
    {
        if (!($it = $this->lot->asIterator())->valid()) {
            throw new LogicException('Can not take currency of empty lot');
        }

        /** @var Money $m */
        $m = $it->current();

        return $m->currency()->asString();
    }
}

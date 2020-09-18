<?php

declare(strict_types=1);


namespace ElegantBro\Money\Ensure;

use ElegantBro\Money\Lot;
use Iterator;
use LogicException;

final class EqualCurrenciesLot implements Lot
{
    /**
     * @var Lot
     */
    private $origin;

    public function __construct(Lot $origin)
    {
        $this->origin = $origin;
    }

    public function asIterator(): Iterator
    {
        $prev = '';
        foreach ($this->origin->asIterator() as $money) {
            $currPrev = $money->currency()->asString();
            if ('' !== $prev && $currPrev !== $prev) {
                throw new LogicException('Currencies are not equals');
            }
            $prev = $currPrev;

            yield $money;
        }
    }
}

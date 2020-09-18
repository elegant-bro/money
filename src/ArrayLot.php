<?php

declare(strict_types=1);


namespace ElegantBro\Money;

use ArrayIterator;
use Iterator;

final class ArrayLot implements Lot
{
    /**
     * @var Money[]
     */
    private $monies;

    public function __construct(Money ...$monies)
    {
        $this->monies = $monies;
    }

    public function asIterator(): Iterator
    {
        return new ArrayIterator($this->monies);
    }
}

<?php

declare(strict_types=1);


namespace ElegantBro\Money;

use ElegantBro\Interfaces\Iteratee;
use Exception;
use Iterator;

/**
 * Interface Lot
 * @package ElegantBro\Money
 */
interface Lot extends Iteratee
{
    /**
     * @return Iterator<Money>|Money[]
     * @throws Exception
     */
    public function asIterator(): Iterator;
}

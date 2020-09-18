<?php

declare(strict_types=1);


namespace ElegantBro\Money\Tests;

use ElegantBro\Money\ArrayLot;
use ElegantBro\Money\Tests\Stub\OneDollar;
use ElegantBro\Money\Tests\Stub\ThreeEuro;
use ElegantBro\Money\Tests\Stub\ThreeRubles;
use ElegantBro\Money\Tests\Stub\TwoDollars;
use Exception;
use PHPUnit\Framework\TestCase;
use function iterator_to_array;

final class ArrayLotTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAsIterator(): void
    {
        self::assertEquals(
            $input = [
                new OneDollar(),
                new TwoDollars(),
                new ThreeEuro(),
                new ThreeRubles()
            ],
            iterator_to_array(
                (new ArrayLot(...$input))->asIterator()
            )
        );
    }
}

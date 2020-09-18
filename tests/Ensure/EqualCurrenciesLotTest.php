<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Ensure;

use ElegantBro\Money\ArrayLot;
use ElegantBro\Money\Ensure\EqualCurrenciesLot;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use ElegantBro\Money\Tests\Stub\OneDollar;
use ElegantBro\Money\Tests\Stub\ThreeEuro;
use ElegantBro\Money\Tests\Stub\TwoDollars;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;
use function iterator_to_array;

final class EqualCurrenciesLotTest extends TestCase
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
                new FiveAndHalfDollars()
            ],
            iterator_to_array(
                (new EqualCurrenciesLot(
                    new ArrayLot(...$input)
                ))->asIterator()
            )
        );
    }
    /**
     * @throws Exception
     */
    public function testAsIteratorException(): void
    {
        $this->expectException(LogicException::class);
        iterator_to_array(
            (new EqualCurrenciesLot(
                new ArrayLot(
                    new OneDollar(),
                    new TwoDollars(),
                    new ThreeEuro(),
                    new FiveAndHalfDollars()
                )
            ))->asIterator()
        );
    }
}

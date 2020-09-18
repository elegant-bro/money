<?php

declare(strict_types=1);


namespace ElegantBro\Money\Tests\Currencies;

use ElegantBro\Money\ArrayLot;
use ElegantBro\Money\Currencies\LotFirstCurrency;
use ElegantBro\Money\Tests\Stub\OneDollar;
use ElegantBro\Money\Tests\Stub\OneRuble;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;

final class LotFirstCurrencyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAsString(): void
    {
        self::assertEquals(
            'RUB',
            (new LotFirstCurrency(
                new ArrayLot(
                    new OneRuble(),
                    new OneDollar()
                )
            ))->asString()
        );

        self::assertEquals(
            'USD',
            (new LotFirstCurrency(
                new ArrayLot(
                    new OneDollar(),
                    new OneRuble()
                )
            ))->asString()
        );
    }

    /**
     * @throws Exception
     */
    public function testEmptyLot(): void
    {
        $this->expectException(LogicException::class);
        (new LotFirstCurrency(
            new ArrayLot()
        ))->asString();
    }
}

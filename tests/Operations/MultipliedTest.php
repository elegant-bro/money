<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\Operations\Multiplied;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use ElegantBro\Money\Tests\Stub\JustNumeric;
use ElegantBro\Money\Tests\Stub\ZeroBelarusRuble;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MultipliedTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testKeepScaleConstructor(): void
    {
        self::assertEquals(
            '2.75',
            ($p = Multiplied::keepScale(
                new FiveAndHalfDollars(),
                new JustNumeric('.5')
            ))->amount()
        );

        self::assertEquals(
            2,
            $p->scale()
        );

        self::assertEquals(
            'USD',
            $p->currency()->asString()
        );
    }

    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void
    {
        self::assertEquals(
            '2.75',
            ($p = new Multiplied(
                new FiveAndHalfDollars(),
                new JustNumeric('.5'),
                2
            ))->amount()
        );

        self::assertEquals(
            'USD',
            $p->currency()->asString()
        );

        self::assertEquals(
            2,
            $p->scale()
        );

        self::assertEquals(
            '0.0000',
            ($b = new Multiplied(
                new ZeroBelarusRuble(),
                new JustNumeric('.1234'),
                4
            ))->amount()
        );

        self::assertEquals(
            'BYN',
            $b->currency()->asString()
        );
    }

    /**
     * @throws Exception
     */
    public function testAmount(): void
    {
        self::assertEquals(
            '5001885077621.010000',
            (new Multiplied(
                new JustMoney('100', new USD(), 2),
                new JustNumeric('50018850776.210100'),
                6
            ))->amount()
        );
    }

    /**
     * @throws Exception
     */
    public function testInvalidPart(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new Multiplied(
            new FiveAndHalfDollars(),
            new JustNumeric('1z'),
            4
        ))->amount();
    }
}

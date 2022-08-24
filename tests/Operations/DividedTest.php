<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Operations\Divided;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use ElegantBro\Money\Tests\Stub\ZeroBelarusRuble;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class DividedTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testKeepScaleConstructor(): void
    {
        self::assertEquals(
            '1.83',
            ($p = Divided::keepScale(
                new FiveAndHalfDollars(),
                '3'
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
    }

    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void
    {
        self::assertEquals(
            '1.8333',
            ($p = new Divided(
                new FiveAndHalfDollars(),
                '3',
                4
            ))->amount()
        );

        self::assertEquals(
            'USD',
            $p->currency()->asString()
        );

        self::assertEquals(
            '0.0000',
            ($b = new Divided(
                new ZeroBelarusRuble(),
                '15',
                4
            ))->amount()
        );

        self::assertEquals(
            4,
            $b->scale()
        );

        self::assertEquals(
            'BYN',
            $b->currency()->asString()
        );
    }

    public function testInvalidDenominator(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Denominator must be numeric, Foo given');
        new Divided(new FiveAndHalfDollars(), 'Foo', 4);
    }

    public function testZeroDenominator(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Denominator must not be zero');
        new Divided(new FiveAndHalfDollars(), '0', 4);
    }

    /**
     * @throws Exception
     */
    public function testNonZeroDenominator(): void
    {
        self::assertEquals(
            '55.0000',
            (new Divided(new FiveAndHalfDollars(), '0.1', 4))
                ->amount()
        );
    }
}

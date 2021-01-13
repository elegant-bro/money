<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Operations\Divided;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use ElegantBro\Money\Tests\Stub\JustNumeric;
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
                new JustNumeric('3')
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
                new JustNumeric('3'),
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
                new JustNumeric('15'),
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

    /**
     * @throws Exception
     */
    public function testZeroDenominator(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Divisor must not be zero');
        (new Divided(
            new FiveAndHalfDollars(),
            new JustNumeric('0'),
            4
        ))->amount();
    }
}

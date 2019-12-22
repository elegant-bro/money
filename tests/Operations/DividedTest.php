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
    public function testAmountCurrency(): void
    {
        $this->assertEquals(
            '1.8333',
            ($p = new Divided(
                new FiveAndHalfDollars(),
                3
            ))->amount()
        );

        $this->assertEquals(
            'USD',
            $p->currency()->asString()
        );

        $this->assertEquals(
            '0.0000',
            ($b = new Divided(
                new ZeroBelarusRuble(),
                '15'
            ))->amount()
        );

        $this->assertEquals(
            'BYN',
            $b->currency()->asString()
        );
    }

    public function testInvalidDenominator(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Denominator must be numeric, Array given');
        new Divided(new FiveAndHalfDollars(), []);
    }

    public function testZeroDenominator(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Denominator must not be zero');
        new Divided(new FiveAndHalfDollars(), 0);
    }
}

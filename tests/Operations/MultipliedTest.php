<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Operations\Multiplied;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use ElegantBro\Money\Tests\Stub\ZeroBelarusRuble;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MultipliedTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void
    {
        $this->assertEquals(
            '2.75',
            ($p = new Multiplied(
                new FiveAndHalfDollars(),
                '.5'
            ))->amount()
        );

        $this->assertEquals(
            'USD',
            $p->currency()->asString()
        );

        $this->assertEquals(
            '0.0000',
            ($b = new Multiplied(
                new ZeroBelarusRuble(),
                '.1234'
            ))->amount()
        );

        $this->assertEquals(
            'BYN',
            $b->currency()->asString()
        );
    }

    public function testInvalidPart(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Multiplied(new FiveAndHalfDollars(), '1z');
    }
}

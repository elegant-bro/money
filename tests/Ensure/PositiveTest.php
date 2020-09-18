<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Ensure;

use ElegantBro\Money\Ensure\Positive;
use ElegantBro\Money\Operations\Minus;
use ElegantBro\Money\Tests\Stub\ThreeEuro;
use ElegantBro\Money\Tests\Stub\ZeroBelarusRuble;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;

final class PositiveTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void
    {
        self::assertEquals(
            'EUR',
            ($m = new Positive(
                new ThreeEuro()
            ))->currency()->asString()
        );

        self::assertEquals(
            '3',
            $m->amount()
        );

        self::assertEquals(
            2,
            $m->scale()
        );

        self::assertEquals(
            '0',
            ($m = new Positive(
                new ZeroBelarusRuble()
            ))->amount()
        );
    }

    /**
     * @throws Exception
     */
    public function testNotPositive(): void
    {
        $this->expectException(LogicException::class);
        (new Positive(
            new Minus(
                new ThreeEuro()
            )
        ))->amount();
    }
}

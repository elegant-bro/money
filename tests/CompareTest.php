<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests;

use ElegantBro\Money\Compare;
use ElegantBro\Money\Currencies\EUR;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\Operations\Minus;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use Exception;
use PHPUnit\Framework\TestCase;
use function ElegantBro\Money\money;

final class CompareTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAsInt(): void
    {
        $this->assertEquals(
            0,
            (new Compare(
                money('10.92', 'RUB', 2),
                money('10.92', 'RUB', 2)
            ))->asInt()
        );

        $this->assertEquals(
            1,
            (new Compare(
                money('11.92', 'RUB', 2),
                money('10.92', 'RUB', 2)
            ))->asInt()
        );

        $this->assertEquals(
            -1,
            (new Compare(
                money('10.92', 'RUB', 2),
                money('11.92', 'RUB', 2)
            ))->asInt()
        );
    }

    /**
     * @throws Exception
     */
    public function testWithZero(): void
    {
        $this->assertEquals(
            1,
            Compare::withZero(
                new FiveAndHalfDollars()
            )->asInt()
        );

        $this->assertEquals(
            -1,
            Compare::withZero(
                new Minus(new FiveAndHalfDollars())
            )->asInt()
        );

        $this->assertEquals(
            0,
            Compare::withZero(
                new JustMoney('0', new EUR(), 3)
            )->asInt()
        );
    }
}

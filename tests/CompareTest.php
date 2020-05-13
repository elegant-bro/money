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
use ElegantBro\Money\Money;
use ElegantBro\Money\Operations\Minus;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use Exception;
use LogicException;
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

    /**
     * @throws Exception
     * @dataProvider comparisonDataProvider
     */
    public function testHandlers(Money $left, Money $right, bool $greaterThan, bool $lessThan, bool $greaterOrEquals, bool $lessOrEquals, bool $expectedException = false): void
    {
        if ($expectedException) {
            $this->expectException(LogicException::class);
        }
        $this->assertEquals($greaterThan, (new Compare($left, $right))->greater(), 'expect what left greater than right');
        $this->assertEquals($lessThan, (new Compare($left, $right))->less(), 'expect what left less than right');
        $this->assertEquals($greaterOrEquals, (new Compare($left, $right))->greaterEq(), 'expect what left greater or equals than right');
        $this->assertEquals($lessOrEquals, (new Compare($left, $right))->lessEq(), 'expect what left less or equals than right');
    }

    public function comparisonDataProvider(): array
    {
        return [
            [
                money('100', 'RUB', 3), // left
                money('100', 'RUB', 3), // right
                false, // greaterThan
                false, // lessThan
                true, // greaterOrEquals
                true, // lessOrEquals
                false, // expectedException
            ],
            [
                money('101', 'RUB', 3), // left
                money('100', 'RUB', 3), // right
                true, // greaterThan
                false, // lessThan
                true, // greaterOrEquals
                false, // lessOrEquals
                false, // expectedException
            ],
            [
                money('100', 'RUB', 3), // left
                money('101', 'RUB', 3), // right
                false, // greaterThan
                true, // lessThan
                false, // greaterOrEquals
                true, // lessOrEquals
                false, // expectedException
            ],
            [
                money('-100', 'RUB', 3), // left
                money('-101', 'RUB', 3), // right
                true, // greaterThan
                false, // lessThan
                true, // greaterOrEquals
                false, // lessOrEquals
                false, // expectedException
            ],
            [
                money('100', 'RUB', 3), // left
                money('101', 'EUR', 3), // right
                false, // greaterThan
                true, // lessThan
                false, // greaterOrEquals
                true, // lessOrEquals
                true, // expectedException
            ],
            [
                money('100', 'RUB', 3), // left
                money('101', 'RUB', 5), // right
                false, // greaterThan
                true, // lessThan
                false, // greaterOrEquals
                true, // lessOrEquals
                true, // expectedException
            ],

        ];
    }
}

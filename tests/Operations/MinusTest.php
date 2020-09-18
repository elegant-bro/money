<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Currencies\EUR;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\Operations\Minus;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use Exception;
use PHPUnit\Framework\TestCase;

final class MinusTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testNegativeAmountCurrency(): void
    {
        self::assertEquals(
            '-5.5',
            ($n = new Minus(
                new FiveAndHalfDollars()
            ))->amount()
        );

        self::assertEquals(
            'USD',
            $n->currency()->asString()
        );
    }
    /**
     * @throws Exception
     */
    public function testPositiveAmountCurrency(): void
    {
        self::assertEquals(
            '10.46',
            ($n = new Minus(
                new JustMoney('-10.46', new EUR(), 2)
            ))->amount()
        );

        self::assertEquals(
            2,
            $n->scale()
        );

        self::assertEquals(
            'EUR',
            $n->currency()->asString()
        );
    }
}

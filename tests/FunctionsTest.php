<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use function ElegantBro\Money\money;

final class FunctionsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testMoney(): void
    {
        self::assertEquals(
            'EUR',
            ($m = money('100.33', 'EUR', 2))
                ->currency()
                ->asString()
        );

        self::assertEquals(
            '100.33',
            $m->amount()
        );
    }

    public function testMoneyInvalidCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);
        money('5', 'LOL', 0);
    }

    public function testMoneyInvalidAmount(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount must be numeric, Baz given');
        money('Baz', 'USD', 2);
    }
}

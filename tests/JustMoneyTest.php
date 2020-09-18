<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests;

use ElegantBro\Money\Currencies\RUB;
use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\JustMoney;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class JustMoneyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test(): void
    {
        self::assertEquals(
            'RUB',
            ($m = new JustMoney('100.5', new RUB(), 2))
                ->currency()
                ->asString()
        );

        self::assertEquals(
            '100.50',
            $m->amount()
        );

        self::assertEquals(
            2,
            $m->scale()
        );
    }

    public function testInvalidAmount(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new JustMoney('100foo', new USD(), 2);
    }
}

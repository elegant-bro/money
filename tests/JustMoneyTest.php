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
        $this->assertEquals(
            'RUB',
            ($m = new JustMoney('100.5', new RUB()))
                ->currency()
                ->asString()
        );

        $this->assertEquals(
            '100.5',
            $m->amount()
        );
    }

    public function testInvalidAmount(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new JustMoney('100foo', new USD());
    }
}

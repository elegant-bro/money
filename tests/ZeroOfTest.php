<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests;

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\ZeroOf;
use Exception;
use PHPUnit\Framework\TestCase;

final class ZeroOfTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test(): void
    {
        self::assertEquals(
            'USD',
            ($m = new ZeroOf(new JustMoney('128.256', new USD(), 4)))
                ->currency()
                ->asString()
        );

        self::assertEquals(
            '0',
            $m->amount()
        );

        self::assertEquals(
            4,
            $m->scale()
        );
    }
}

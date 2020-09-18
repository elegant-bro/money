<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests;

use ElegantBro\Money\Currencies\RUB;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\SameAs;
use Exception;
use PHPUnit\Framework\TestCase;

final class SameAsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test(): void
    {
        self::assertEquals(
            'RUB',
            ($m = new SameAs(new JustMoney('3333.44', new RUB(), 3), '10'))
                ->currency()
                ->asString()
        );

        self::assertEquals(
            '10',
            $m->amount()
        );

        self::assertEquals(
            3,
            $m->scale()
        );
    }
}

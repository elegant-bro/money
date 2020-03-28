<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\Operations\DiffOf;
use Exception;
use PHPUnit\Framework\TestCase;

final class DiffOfTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void
    {
        $this->assertEquals(
            '-0.2333',
            ($s = new DiffOf(
                new JustMoney('1', new USD(), 4),
                new JustMoney('1.2333', new USD(), 4)
            ))->amount()
        );

        $this->assertEquals(
            4,
            $s->scale()
        );

        $this->assertEquals(
            'USD',
            $s->currency()->asString()
        );
    }
}

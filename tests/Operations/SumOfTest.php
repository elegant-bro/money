<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\Operations\SumOf;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use Exception;
use PHPUnit\Framework\TestCase;

final class SumOfTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void
    {
        $this->assertEquals(
            '7.7000',
            ($s = new SumOf(
                [
                    new JustMoney('1', new USD()),
                    new JustMoney('1.2', new USD()),
                    new FiveAndHalfDollars()
                ],
                4
            ))->amount()
        );

        $this->assertEquals(
            'USD',
            $s->currency()->asString()
        );
    }
}

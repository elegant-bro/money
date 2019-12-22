<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\JustMoney;
use ElegantBro\Money\Operations\SumOf;
use PHPUnit\Framework\TestCase;

final class SumOfTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testAmountCurrency(): void
    {
        $this->assertEquals(
            '2.2000',
            (new SumOf(
                new JustMoney('1', 'USD'),
                new JustMoney('1.2', 'USD')
            ))->amount()
        );
    }
}

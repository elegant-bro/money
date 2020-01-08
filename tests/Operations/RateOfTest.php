<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Operations\RateOf;
use ElegantBro\Money\Tests\Stub\OneRuble;
use ElegantBro\Money\Tests\Stub\ThreeEuro;
use ElegantBro\Money\Tests\Stub\ThreeRubles;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;

final class RateOfTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAsNumber(): void
    {
        $this->assertEquals(
            '0.33333333',
            (new RateOf(
                new OneRuble(),
                new ThreeRubles()
            ))->asNumber()
        );
    }

    /**
     * @throws Exception
     */
    public function testAsNumberFails(): void
    {
        $this->expectException(LogicException::class);
        (new RateOf(
            new OneRuble(),
            new ThreeEuro()
        ))->asNumber();
    }
}
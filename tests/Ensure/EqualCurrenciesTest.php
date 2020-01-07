<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Ensure;

use ElegantBro\Money\Currencies\RUB;
use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\Ensure\EqualCurrencies;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;

final class EqualCurrenciesTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAsString(): void
    {
        $this->assertEquals(
            'USD',
            (new EqualCurrencies(
                new USD(),
                new USD(),
                new USD()
            ))->asString()
        );
    }
    /**
     * @throws Exception
     */
    public function testAsStringException(): void
    {
        $this->expectException(LogicException::class);
        (new EqualCurrencies(
            new USD(),
            new RUB()
        ))->asString();
    }
}

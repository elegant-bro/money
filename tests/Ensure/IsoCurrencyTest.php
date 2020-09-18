<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Ensure;

use ElegantBro\Money\Ensure\IsoCurrency;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class IsoCurrencyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testValidCurrency(): void
    {
        self::assertEquals(
            'USD',
            (new IsoCurrency('USD'))->asString()
        );
        self::assertEquals(
            'RUB',
            (new IsoCurrency('RUB'))->asString()
        );
        self::assertEquals(
            'EUR',
            (new IsoCurrency('EUR'))->asString()
        );
    }

    /**
     * @throws Exception
     */
    public function testInvalidCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new IsoCurrency('LOL');
    }
}

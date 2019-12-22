<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Ensure;


use ElegantBro\Money\Ensure\IsoCurrency;
use PHPUnit\Framework\TestCase;

final class IsoCurrencyTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testValidCurrency(): void
    {
        $this->assertEquals(
            'USD',
            (new IsoCurrency('USD'))->asString()
        );
        $this->assertEquals(
            'RUB',
            (new IsoCurrency('RUB'))->asString()
        );
        $this->assertEquals(
            'EUR',
            (new IsoCurrency('EUR'))->asString()
        );
    }

    /**
     * @throws \Exception
     */
    public function testInvalidCurrency(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new IsoCurrency('LOL');
    }
}
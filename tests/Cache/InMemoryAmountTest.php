<?php

declare(strict_types=1);


namespace ElegantBro\Money\Tests\Cache;

use ElegantBro\Money\Cache\InMemoryAmount;
use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\Currency;
use ElegantBro\Money\FnMoney;
use Exception;
use PHPUnit\Framework\TestCase;

final class InMemoryAmountTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmount(): void
    {
        $amountCall = 0;
        $currencyCall = 0;
        $scaleCall = 0;

        $origin = new FnMoney(
            static function () use (&$amountCall): string {
                ++$amountCall;
                return '1';
            },
            static function () use (&$currencyCall): Currency {
                ++$currencyCall;
                return new USD();
            },
            static function () use (&$scaleCall): int {
                ++$scaleCall;
                return 2;
            }
        );

        self::assertEquals(
            '1.00',
            ($cached = new InMemoryAmount($origin))->amount()
        );
        self::assertEquals(
            '1.00',
            $cached->amount()
        );

        self::assertEquals(
            'USD',
            $cached->currency()->asString()
        );

        self::assertEquals(
            'USD',
            $cached->currency()->asString()
        );

        self::assertEquals(
            2,
            $cached->scale()
        );

        self::assertEquals(
            2,
            $cached->scale()
        );

        self::assertEquals(1, $amountCall);
        self::assertEquals(1, $currencyCall);
        self::assertEquals(1, $scaleCall);
    }
}

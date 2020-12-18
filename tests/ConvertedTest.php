<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 */

namespace ElegantBro\Money\Tests;

use ElegantBro\Money\Converted;
use ElegantBro\Money\Currencies\RUB;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Ratios\FnRatio;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use ElegantBro\Money\Tests\Stub\JustNumeric;
use Exception;
use PHPUnit\Framework\TestCase;

final class ConvertedTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAll(): void
    {
        self::assertEquals(
            '425.37',
            ($money = new Converted(
                new FiveAndHalfDollars(),
                new RUB(),
                new FnRatio(static function (Currency $base, Currency $minor) {
                    self::assertEquals('USD', $base->asString());
                    self::assertEquals('RUB', $minor->asString());
                    return new JustNumeric('77.34');
                }),
                2
            ))->amount()
        );

        self::assertEquals(
            'RUB',
            $money->currency()->asString()
        );

        self::assertEquals(
            2,
            $money->scale()
        );
    }
}

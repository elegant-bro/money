<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\Operations\Converted;
use ElegantBro\Money\Tests\Stub\StubRatio;
use ElegantBro\Money\Tests\Stub\ThreeRubles;
use Exception;
use PHPUnit\Framework\TestCase;

final class ConvertedTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test(): void
    {
        $this->assertEquals(
            0.048,
            ($c = new Converted(
                new ThreeRubles(),
                new USD(),
                new StubRatio('0.016')
            ))->amount()
        );

        $this->assertEquals(
            'USD',
            $c->currency()->asString()
        );
    }
}

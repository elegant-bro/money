<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Operations\Converted;
use ElegantBro\Money\Ratio;
use ElegantBro\Money\Tests\Stub\JustNumeric;
use ElegantBro\Money\Tests\Stub\ThreeRubles;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ConvertedTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test(): void
    {
        /** @var Ratio & MockObject $ratio */
        $ratio = $this->getMockForAbstractClass(Ratio::class);
        $ratio->expects(self::once())
            ->method('of')
            ->with(
                $this->callback(static function (Currency $arg) {
                    return $arg->asString() === 'RUB';
                }),
                $this->callback(static function (Currency $arg) {
                    return $arg->asString() === 'USD';
                })
            )
            ->willReturn(
                new JustNumeric('0.016')
            );

        $this->assertEquals(
            0.048,
            ($c = new Converted(
                new ThreeRubles(),
                new USD(),
                $ratio,
                4
            ))->amount()
        );

        $this->assertEquals(
            4,
            $c->scale()
        );

        $this->assertEquals(
            'USD',
            $c->currency()->asString()
        );
    }
}

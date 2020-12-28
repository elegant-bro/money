<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 */

namespace ElegantBro\Money\Tests;

use ElegantBro\Money\Tests\Stub\ThreeRubles;
use ElegantBro\Money\Tests\Stub\Wrapped;
use Exception;
use PHPUnit\Framework\TestCase;

final class WrapperTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test(): void
    {
        self::assertEquals(
            'RUB',
            ($m = new Wrapped(new ThreeRubles()))
                ->currency()
                ->asString()
        );

        self::assertEquals(
            '3.00',
            $m->amount()
        );

        self::assertEquals(
            2,
            $m->scale()
        );
    }
}

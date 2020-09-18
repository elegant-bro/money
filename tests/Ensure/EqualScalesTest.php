<?php

declare(strict_types=1);


namespace ElegantBro\Money\Tests\Ensure;

use ElegantBro\Money\Ensure\EqualScales;
use LogicException;
use PHPUnit\Framework\TestCase;

final class EqualScalesTest extends TestCase
{
    public function testAsInt(): void
    {
        self::assertEquals(
            3,
            (new EqualScales(3, 3, 3, 3))->asInt()
        );
    }

    public function testAsIntFails(): void
    {
        $this->expectException(LogicException::class);
        self::assertEquals(
            3,
            (new EqualScales(3, 3, 4, 3))->asInt()
        );
    }

    public function testValidate(): void
    {
        (new EqualScales(4, 4, 4, 4))->validate();
        self::assertTrue(true);
    }

    public function testValidateFails(): void
    {
        $this->expectException(LogicException::class);
        (new EqualScales(7, 3, 4, 3))->validate();
    }
}

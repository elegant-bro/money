<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Ensure;


use ElegantBro\Money\Ensure\Positive;
use ElegantBro\Money\Operations\Minus;
use ElegantBro\Money\Tests\Stub\ThreeEoru;
use ElegantBro\Money\Tests\Stub\ZeroBelarusRuble;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;

final class PositiveTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void 
    {
        $this->assertEquals(
            'EUR',
            ($m = new Positive(
                new ThreeEoru()
            ))->currency()->asString()
        );
        
        $this->assertEquals(
            '3',
            $m->amount()
        );

        $this->assertEquals(
            '0',
            ($m = new Positive(
                new ZeroBelarusRuble()
            ))->amount()
        );
    }

    public function testNotPositive(): void
    {
        $this->expectException(LogicException::class);
        (new Positive(
            new Minus(
                new ThreeEoru()
            )
        ))->amount();
    }
}
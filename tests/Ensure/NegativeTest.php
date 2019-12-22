<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Ensure;


use ElegantBro\Money\Ensure\Negative;
use ElegantBro\Money\Operations\Minus;
use ElegantBro\Money\Tests\Stub\OneRuble;
use ElegantBro\Money\Tests\Stub\ZeroBelarusRuble;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;

final class NegativeTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void 
    {
        $this->assertEquals(
            'RUB',
            ($m = new Negative(
                new Minus(
                    new OneRuble()
                )
            ))->currency()->asString()
        );
        
        $this->assertEquals(
            '-1',
            $m->amount()
        );

        $this->assertEquals(
            '0',
            ($m = new Negative(
                new ZeroBelarusRuble()
            ))->amount()
        );
    }

    public function testNotNegative(): void
    {
        $this->expectException(LogicException::class);
        (new Negative(
            new OneRuble()
        ))->amount();
    }
}
<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Tests\Operations;


use ElegantBro\Money\Operations\Minus;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use Exception;
use PHPUnit\Framework\TestCase;

final class MinusTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void
    {
        $this->assertEquals(
            '-5.5',
            ($n = new Minus(
                new FiveAndHalfDollars()
            ))->amount()
        );

        $this->assertEquals(
            'USD',
            $n->currency()->asString()
        );
    }
}
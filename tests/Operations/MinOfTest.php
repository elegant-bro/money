<?php

declare(strict_types=1);


namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\ArrayLot;
use ElegantBro\Money\Operations\MinOf;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use ElegantBro\Money\Tests\Stub\OneDollar;
use ElegantBro\Money\Tests\Stub\OneRuble;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;
use function ElegantBro\Money\money;

final class MinOfTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testDifferentCurrencies(): void
    {
        $this->expectException(LogicException::class);
        (new MinOf(
            new ArrayLot(
                new OneDollar(),
                new FiveAndHalfDollars(),
                new OneRuble()
            ),
            2
        ))->amount();
    }

    /**
     * @throws Exception
     */
    public function testEmptyLot(): void
    {
        $this->expectException(LogicException::class);
        (new MinOf(
            new ArrayLot(),
            2
        ))->amount();
    }

    /**
     * @param array $amounts
     * @param string $expected
     * @param int $scale
     * @throws Exception
     * @dataProvider amounts
     */
    public function testAll(array $amounts, string $expected, int $scale): void
    {
        self::assertEquals(
            $expected,
            ($m = new MinOf(
                new ArrayLot(
                    ...array_map(
                        static function (string $amount) use ($scale) {
                            return money($amount, 'USD', $scale);
                        },
                        $amounts
                    )
                ),
                $scale
            ))->amount()
        );

        self::assertEquals(
            'USD',
            $m->currency()->asString()
        );

        self::assertEquals(
            $scale,
            $m->scale()
        );
    }

    public function amounts(): array
    {
        return [
            [['10', '-10', '0', '4'], '-10.00', 2],
            [['0', '10', '0', '4', '1'], '0.000', 3],
            [['123.345', '90000', '34768', '24631'], '123.34', 2],
            [['-3.3333', '-3.3334', '7', '8'], '-3.3334', 4],
            [['-3.3333', '-3.3334', '7', '8'], '-3.33', 2],
        ];
    }
}

<?php

declare(strict_types=1);


namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\ArrayLot;
use ElegantBro\Money\Operations\MaxOf;
use ElegantBro\Money\Tests\Stub\FiveAndHalfDollars;
use ElegantBro\Money\Tests\Stub\OneDollar;
use ElegantBro\Money\Tests\Stub\OneRuble;
use Exception;
use LogicException;
use PHPUnit\Framework\TestCase;
use function ElegantBro\Money\money;

final class MaxOfTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testDifferentCurrencies(): void
    {
        $this->expectException(LogicException::class);
        (new MaxOf(
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
        (new MaxOf(
            new ArrayLot(),
            2
        ))->amount();
    }

    /**
     * @param array<array> $amounts
     * @param string $expected
     * @param int $scale
     * @throws Exception
     * @dataProvider amounts
     */
    public function testAll(array $amounts, string $expected, int $scale): void
    {
        self::assertEquals(
            $expected,
            ($m = new MaxOf(
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

    /**
     * @return array<array>
     */
    public function amounts(): array
    {
        return [
            [['10', '-10', '0', '4'], '10.00', 2],
            [['0', '10', '0', '48', '1'], '48.00', 2],
            [['123.345', '90000', '347686', '24631'], '347686.00', 2],
            [['3.3333', '3.3334', '1', '2'], '3.333', 3],
            [['3.3333', '3.3334', '1', '2'], '3.3334', 4],
        ];
    }
}

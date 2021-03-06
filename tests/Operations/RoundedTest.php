<?php

declare(strict_types=1);


namespace ElegantBro\Money\Tests\Operations;

use ElegantBro\Money\Currencies\RUB;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\Operations\Rounded;
use Exception;
use PHPUnit\Framework\TestCase;

final class RoundedTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountCurrency(): void
    {
        self::assertEquals(
            '2.0000',
            (new Rounded(
                new JustMoney('1.99999999999', new RUB(), 12),
                4
            ))->amount()
        );

        self::assertEquals(
            '1.96',
            (new Rounded(
                new JustMoney('1.95583', new RUB(), 5),
                2
            ))->amount()
        );

        self::assertEquals(
            '5.055',
            ($scaled = new Rounded(
                new JustMoney('5.055123', new RUB(), 6),
                3
            ))->amount()
        );

        self::assertEquals(
            '3',
            ($scaled = new Rounded(
                new JustMoney('3', new RUB(), 0),
                0
            ))->amount()
        );

        self::assertEquals(
            '4',
            ($scaled = new Rounded(
                new JustMoney('3.5', new RUB(), 2),
                0
            ))->amount()
        );

        self::assertEquals(
            '-4',
            ($scaled = new Rounded(
                new JustMoney('-3.5', new RUB(), 2),
                0
            ))->amount()
        );

        self::assertEquals(
            'RUB',
            $scaled->currency()->asString()
        );

        self::assertEquals(
            0,
            $scaled->scale()
        );
    }
}

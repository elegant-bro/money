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
        $this->assertEquals(
            '2.0000',
            (new Rounded(
                new JustMoney('1.99999999999', new RUB()),
                4
            )
            )->amount()
        );

        $this->assertEquals(
            '1.96',
            (new Rounded(
                new JustMoney('1.95583', new RUB()),
                2
            )
            )->amount()
        );

        $this->assertEquals(
            '5.055',
            (
                $scaled = new Rounded(
                new JustMoney('5.055123', new RUB()),
                3
            )
            )->amount()
        );

        $this->assertEquals(
            '3',
            (
                $scaled = new Rounded(
                new JustMoney('3', new RUB()),
                0
            )
            )->amount()
        );

        $this->assertEquals(
            '4',
            (
                $scaled = new Rounded(
                new JustMoney('3.5', new RUB()),
                0
            )
            )->amount()
        );

        $this->assertEquals(
            '-4',
            (
                $scaled = new Rounded(
                new JustMoney('-3.5', new RUB()),
                0
            )
            )->amount()
        );

        $this->assertEquals(
            'RUB',
            $scaled->currency()->asString()
        );
    }
}

<?php

declare(strict_types=1);

namespace ElegantBro\Money\Operations;

use ElegantBro\Interfaces\Numeric as Num;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use Exception;
use InvalidArgumentException;
use function bcdiv;

final class Divided implements Money
{
    /**
     * @var Money
     */
    private $money;

    /**
     * @var Numeric
     */
    private $divisor;

    /**
     * @var int
     */
    private $scale;

    /**
     * @param Money $money
     * @param Num $divisor
     * @return Divided
     * @throws Exception
     */
    public static function keepScale(Money $money, Num $divisor): self
    {
        return new self($money, $divisor, $money->scale());
    }

    public function __construct(Money $money, Num $divisor, int $scale)
    {
        $this->divisor = $divisor;
        $this->money = $money;
        $this->scale = $scale;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        if (!is_numeric($d = $this->divisor->asNumber())) {
            throw new InvalidArgumentException("Divisor must be numeric, $d given");
        }

        if ((float)$d === 0.0) {
            throw new InvalidArgumentException('Divisor must not be zero');
        }

        return bcdiv($this->money->amount(), $d, $this->scale) ?? '0';
    }

    /**
     * @inheritDoc
     */
    public function currency(): Currency
    {
        return $this->money->currency();
    }

    /**
     * @inheritDoc
     */
    public function scale(): int
    {
        return $this->scale;
    }
}

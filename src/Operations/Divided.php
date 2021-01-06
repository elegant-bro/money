<?php

declare(strict_types=1);

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use Exception;
use InvalidArgumentException;

use function bccomp;
use function bcdiv;
use function is_numeric;

final class Divided implements Money
{
    /**
     * @var Money
     */
    private $money;

    /**
     * @var string
     */
    private $denominator;

    /**
     * @var int
     */
    private $scale;

    /**
     * @param Money $money
     * @param string $multiplier
     * @return Divided
     * @throws Exception
     */
    public static function keepScale(Money $money, string $multiplier): self
    {
        return new self($money, $multiplier, $money->scale());
    }

    public function __construct(Money $money, string $denominator, int $scale)
    {
        if (!is_numeric($denominator)) {
            throw new InvalidArgumentException("Denominator must be numeric, $denominator given");
        }
        $this->denominator = $denominator;

        if (bccomp($this->denominator, '0') === 0) {
            throw new InvalidArgumentException('Denominator must not be zero');
        }

        $this->money = $money;
        $this->scale = $scale;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        return bcdiv($this->money->amount(), $this->denominator, $this->scale) ?? '0';
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

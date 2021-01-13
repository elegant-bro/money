<?php

declare(strict_types=1);

namespace ElegantBro\Money\Operations;

use ElegantBro\Interfaces\Numeric as Num;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use Exception;
use InvalidArgumentException;
use function bcmul;
use function is_numeric;

final class Multiplied implements Money
{
    /**
     * @var Money
     */
    private $money;

    /**
     * @var Num
     */
    private $multiplier;

    /**
     * @var int
     */
    private $scale;

    /**
     * @param Money $money
     * @param Num $multiplier
     * @return Multiplied
     * @throws Exception
     */
    public static function keepScale(Money $money, Num $multiplier): self
    {
        return new self($money, $multiplier, $money->scale());
    }

    public function __construct(Money $money, Num $multiplier, int $scale)
    {
        $this->money = $money;
        $this->multiplier = $multiplier;
        $this->scale = $scale;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        if (!is_numeric($m = $this->multiplier->asNumber())) {
            throw new InvalidArgumentException("Multiplier must be numeric, $m given");
        }
        return bcmul($this->money->amount(), $m, $this->scale);
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

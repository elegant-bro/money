<?php

declare(strict_types=1);

namespace ElegantBro\Money\Operations;

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
     * @var string
     */
    private $multiplier;

    /**
     * @var int
     */
    private $scale;

    /**
     * @param Money $money
     * @param string $multiplier
     * @return Multiplied
     * @throws Exception
     */
    public static function keepScale(Money $money, string $multiplier): self
    {
        return new self($money, $multiplier, $money->scale());
    }

    public function __construct(Money $money, string $multiplier, int $scale)
    {
        if (!is_numeric($multiplier)) {
            throw new InvalidArgumentException("Multiplier must be numeric, $multiplier given");
        }
        $this->money = $money;
        $this->multiplier = $multiplier;
        $this->scale = $scale;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        return bcmul($this->money->amount(), $this->multiplier, $this->scale);
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

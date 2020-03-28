<?php

declare(strict_types=1);


namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use function bcadd;
use function bcsub;
use function str_repeat;

final class Rounded implements Money
{
    /**
     * @var Money
     */
    private $origin;

    /**
     * @var int
     */
    private $scale;

    public function __construct(Money $origin, int $scale)
    {
        $this->origin = $origin;
        $this->scale = $scale;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        if (false !== strpos($number = $this->origin->amount(), '.')) {
            if ($number[0] !== '-') {
                return bcadd($number, '0.' . str_repeat('0', $this->scale) . '5', $this->scale);
            }
            return bcsub($number, '0.' . str_repeat('0', $this->scale) . '5', $this->scale);
        }
        return $number;
    }

    /**
     * @inheritDoc
     */
    public function currency(): Currency
    {
        return $this->origin->currency();
    }

    /**
     * @inheritDoc
     */
    public function scale(): int
    {
        return $this->scale;
    }
}

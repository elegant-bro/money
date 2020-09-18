<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money;

use InvalidArgumentException;
use function bcadd;
use function is_numeric;

final class JustMoney implements Money
{
    /**
     * @var string
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var int
     */
    private $scale;

    public function __construct(string $amount, Currency $currency, int $scale)
    {
        if (!is_numeric($amount)) {
            throw new InvalidArgumentException("Amount must be numeric, $amount given");
        }
        $this->amount = $amount;
        $this->currency = $currency;
        $this->scale = $scale;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        return bcadd($this->amount, '0', $this->scale);
    }

    /**
     * @inheritDoc
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * @inheritDoc
     */
    public function scale(): int
    {
        return $this->scale;
    }
}

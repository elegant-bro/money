<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money;

use ElegantBro\Money\Ensure\IsoCurrency;
use InvalidArgumentException;
use function is_numeric;

final class JustMoney implements Money
{
    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    public function __construct(string $amount, string $currency)
    {
        if (!is_numeric($amount)) {
            throw new InvalidArgumentException("Amount must be numeric, $amount given");
        }
        $this->amount = $amount;
        $this->currency = new IsoCurrency($currency);
    }

    public function amount(): string
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }
}
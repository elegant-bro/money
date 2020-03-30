<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Ensure;

use ElegantBro\Money\Currency;
use Exception;
use LogicException;
use function array_slice;

final class EqualCurrencies implements Currency
{
    /**
     * @var Currency[]
     */
    private $currencies;

    public function __construct(Currency ...$currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @inheritDoc
     */
    public function asString(): string
    {
        $test = $this->currencies[0]->asString();
        $this->validate();

        return $test;
    }

    /**
     * @throws Exception
     */
    public function validate(): void
    {
        $test = $this->currencies[0]->asString();
        foreach (array_slice($this->currencies, 1) as $currency) {
            if ($test !== $currency->asString()) {
                throw new LogicException('Currencies are not equals');
            }
        }
    }
}

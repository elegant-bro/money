<?php

declare(strict_types=1);

namespace ElegantBro\Money\Ratios;

use ElegantBro\Interfaces\Numeric;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Ratio;

final class FnRatio implements Ratio
{
    /**
     * @var callable(Currency, Currency): Numeric
     */
    private $ratioFn;

    /**
     * FnRatio constructor.
     * @param callable(Currency, Currency): Numeric $ratioFn
     */
    public function __construct(callable $ratioFn)
    {
        $this->ratioFn = $ratioFn;
    }

    /**
     * @inheritDoc
     */
    public function of(Currency $base, Currency $minor): Numeric
    {
        return ($this->ratioFn)($base, $minor);
    }
}

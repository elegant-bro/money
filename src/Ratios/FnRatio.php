<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 */

namespace ElegantBro\Money\Ratios;

use ElegantBro\Interfaces\Numeric;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Ratio;
use function call_user_func;

final class FnRatio implements Ratio
{
    /**
     * @var callable
     */
    private $ratioFn;

    /**
     * FnRatio constructor.
     * @param callable $ratioFn function(Currency $base, Currency $minor): Numeric
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
        return call_user_func($this->ratioFn, $base, $minor);
    }
}

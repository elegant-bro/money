<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Operations;

use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;
use ElegantBro\Money\Ratio;
use Exception;
use function bcmul;

final class Converted implements Money
{
    /**
     * @var Money
     */
    private $origin;

    /**
     * @var Currency
     */
    private $target;

    /**
     * @var Ratio
     */
    private $ratio;

    /**
     * @var int
     */
    private $scale;

    public function __construct(Money $origin, Currency $target, Ratio $ratio, int $scale)
    {
        $this->origin = $origin;
        $this->target = $target;
        $this->ratio = $ratio;
        $this->scale = $scale;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function amount(): string
    {
        return bcmul(
            $this->origin->amount(),
            $this->ratio
                ->of($this->origin->currency(), $this->target)
                ->asNumber(),
            $this->scale
        );
    }

    public function currency(): Currency
    {
        return $this->target;
    }
}

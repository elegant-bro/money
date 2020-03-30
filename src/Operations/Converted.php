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
     * @inheritDoc
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

    /**
     * @inheritDoc
     */
    public function currency(): Currency
    {
        return $this->target;
    }

    /**
     * @inheritDoc
     */
    public function scale(): int
    {
        return $this->scale;
    }
}

<?php

declare(strict_types=1);

namespace ElegantBro\Money;

use Exception;

/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 */
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
        $this->scale = $scale;
        $this->ratio = $ratio;
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
                ->of(
                    $this->origin->currency(),
                    $this->target
                )->asNumber(),
            $this->scale
        );
    }

    /**
     * @return Currency
     * @throws Exception
     */
    public function currency(): Currency
    {
        return $this->target;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function scale(): int
    {
        return $this->scale;
    }
}

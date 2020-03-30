<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money\Ensure;

use LogicException;

final class EqualScales
{
    /**
     * @var int[]
     */
    private $scales;

    public function __construct(int ...$scales)
    {
        $this->scales = $scales;
    }

    /**
     * @throws LogicException
     */
    public function asInt(): int
    {
        $scaleOrigin = $this->scales[0];
        $this->validate();

        return $scaleOrigin;
    }

    /**
     * @throws LogicException
     */
    public function validate(): void
    {
        $scaleOrigin = $this->scales[0];
        foreach ($this->scales as $scale) {
            if ($scale !== $scaleOrigin) {
                throw new LogicException('Scales are not equal');
            }
        }
    }
}

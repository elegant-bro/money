<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 * @author Artem Dekhtyar <m@artemd.ru>
 */

namespace ElegantBro\Money;

use ElegantBro\Money\Ensure\EqualCurrencies;
use ElegantBro\Money\Ensure\EqualScales;
use Exception;
use function bccomp;

final class Compare
{
    /**
     * @var Money
     */
    private $left;

    /**
     * @var Money
     */
    private $right;

    /**
     * @param Money $money
     * @return static
     */
    public static function withZero(Money $money): self
    {
        return new self($money, new ZeroOf($money));
    }

    public function __construct(Money $left, Money $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function asInt(): int
    {
        (new EqualCurrencies($this->left->currency(), $this->right->currency()))->validate();
        (new EqualScales($scale = $this->left->scale(), $this->right->scale()))->validate();

        return bccomp($this->left->amount(), $this->right->amount(), $scale);
    }
}

<?php

declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 */

namespace ElegantBro\Money\Tests\Stub;


use ElegantBro\Money\Money;
use ElegantBro\Money\Wrapper;

final class Wrapped extends Wrapper
{
    public function __construct(Money $money)
    {
        $this->is($money);
    }
}

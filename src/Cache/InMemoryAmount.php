<?php

declare(strict_types=1);


namespace ElegantBro\Money\Cache;

use ElegantBro\Money\Currency;
use ElegantBro\Money\JustMoney;
use ElegantBro\Money\Money;
use Exception;

/**
 * Calculates and caches amount call of origin money in memory on first call
 * @package ElegantBro\Money\Cache
 */
final class InMemoryAmount implements Money
{
    /**
     * @var Money
     */
    private $origin;

    /**
     * @var Money
     */
    private $cache;

    public function __construct(Money $origin)
    {
        $this->origin = $origin;
    }

    /**
     * @inheritDoc
     */
    public function amount(): string
    {
        $this->initCache();
        return $this->cache->amount();
    }

    /**
     * @inheritDoc
     */
    public function currency(): Currency
    {
        $this->initCache();
        return $this->cache->currency();
    }

    /**
     * @inheritDoc
     */
    public function scale(): int
    {
        $this->initCache();
        return $this->cache->scale();
    }

    /**
     * @throws Exception
     */
    private function initCache(): void
    {
        if (null === $this->cache) {
            $this->cache = new JustMoney(
                $this->origin->amount(),
                $this->origin->currency(),
                $this->origin->scale()
            );
        }
    }
}

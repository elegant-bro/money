[![Latest Version](https://img.shields.io/github/release/elegant-bro/money.svg)](https://github.com/elegant-bro/money/releases)
[![Build Status](https://travis-ci.com/elegant-bro/money.svg?branch=master)](https://travis-ci.com/elegant-bro/money)
[![Coverage Status](https://coveralls.io/repos/github/elegant-bro/money/badge.svg?branch=master)](https://coveralls.io/github/elegant-bro/money?branch=master)

# Elegant money implementation
This library provides classes for money manipulation using pure OOP approach.

## Install

```bash
$ composer require elegant-bro/money
```

## Features
* This implementation is not procedural DTO.
* There is no hundreds-lines class with tens of methods. Every operation is an object implements `Money` interface.
* Lazy execution: you can construct complex expression without immediate calculations.
* Explicit scale to avoid ambiguous results. 

## Examples

The presence of the interface allows you to make different classes.

The simplest class represents `OneDollar`

```php
<?php

declare(strict_types=1);

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

final class OneDollar implements Money
{
    public function amount() : string
    {
        return '1';
    }
    
    public function currency() : Currency
    {
        return new USD();
    }
    
    public function scale() : int
    {
        return 2;
    }

}
```

This is user balance from database
```php
<?php

declare(strict_types=1);

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

final class UserBalance implements Money
{
    /**
     * @var string
     */
    private $userId;
    
    /**
     * @var PDO 
     */
    private $pdo;
     
    public function __construct(string $userId, PDO $pdo)
    {  
        $this->userId = $userId;
        $this->pdo = $pdo;
    } 

    public function amount() : string
    {
        $stmt = $this->pdo->prepare('SELECT SUM(debit - credit) FROM balances WHERE user_id = ?');
        $stmt->execute([$this->userId]);
        return $stmt->fetchColumn();
    }
    
    public function currency() : Currency
    {
        return new USD();
    }
    
    public function scale() : int
    {
        return 2;
    }

}
```

For example, you need some tax which is 10% of given amount but not less than $2.

Using some procedural implementation like [`moneyphp/money`](https://github.com/moneyphp/money) 
you have to create ugly `MoneyHelper` with static `tax` method:

```php
<?php

declare(strict_types=1);

use Money/Money;

class MoneyHelper
{
    public static function tax(Money $amount): Money
    {
        return Money::max(
            $amount->multiply('0.1'),
            new Money(200, $amount->getCurrency())
        );
    }
}

```

This is real object-oriented solution:

```php
<?php

declare(strict_types=1);

use ElegantBro\Money\ArrayLot;
use ElegantBro\Money\Money;
use ElegantBro\Money\Operations\MaxOf;
use ElegantBro\Money\Operations\Multiplied;
use ElegantBro\Money\SameAs;
use ElegantBro\Money\Wrapper;

final class Tax extends Wrapper
{
    public function __construct(Money $origin)
    {  
        $this->is(
            new MaxOf(
                new ArrayLot(
                    Multiplied::keepScale($origin, '0.1'),
                    new SameAs($origin, '2')
                ),
                $origin->scale()
            )
        );
    }
}

```
This is absolutely declarative code, but the biggest advantage is laziness. No one calculation will happen until `amount` method will be called. 

## Tests

**Pass all tests locally before create pull request.**

Build test container and run all tests
```shell
make all
```

Other commands
```shell
# build the Dockerfile
make build 
# install composer requirements
make install
# enter to container shell
make shell
# style check
make style-check
# run unit tests
make unit
# ensure coverage is 100%
make coverage
```

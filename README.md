[![Latest Version](https://img.shields.io/github/release/elegant-bro/money.svg)](https://github.com/elegant-bro/money/releases)
[![Build Status](https://travis-ci.com/elegant-bro/money.svg?branch=master)](https://travis-ci.com/elegant-bro/money)
[![Coverage Status](https://coveralls.io/repos/github/elegant-bro/money/badge.svg?branch=master)](https://coveralls.io/github/elegant-bro/money?branch=master)

# Elegant money implementation
This library provides classes for money manipulation using a pure object-oriented approach.

## Yet another PHP-money, why?
Why did we make yet another PHP-library for money? After all, there are:
* https://github.com/moneyphp/money
* https://github.com/brick/money
* https://github.com/akaunting/money

But, there are disadvantages to using it in pure object-oriented development.

* There are no interfaces — we can't create an object that will represent money itself.
* All existed implementations are classes with hundreds loc and dozens of methods like `add`, `sub`,
  `divide`, `compare` etc., which are essentially procedural style.
* We can't add new functionality as there are no interfaces, and most implementations are final.
* Eager execution — all calculations happen in construct-time as constructor's arguments should be evaluated.
* Existed libraries hide the scale, the only thing we can control is a rounding method.

## Our solution
* We have the `Money` interface! This implementation is not procedural DTO.
* There is no hundreds-lines class with tens of methods. Every operation is an object that implements the `Money` interface.
* Lazy execution: you can construct complex expressions without immediate calculations.
* Explicit scale to avoid ambiguous results.

The presence of the interface allows you to make different classes. For example, you can easily implement `UserBalance`
that takes data from a database or some API or even from a file.

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

    public function amount(): string
    {
        $stmt = $this->pdo->prepare('SELECT SUM(debit - credit) FROM balances WHERE user_id = ?');
        $stmt->execute([$this->userId]);
        
        return $stmt->fetchColumn();
    }
    
    public function currency(): Currency
    {
        return new USD();
    }
    
    public function scale(): int
    {
        return 2;
    }
}
```

Besides, you can create some static implementations like `TwoDollars`:

```php
<?php

declare(strict_types=1);

use ElegantBro\Money\Currencies\USD;
use ElegantBro\Money\Currency;
use ElegantBro\Money\Money;

final class TwoDollars implements Money
{
    public function amount(): string
    {
        return '2';
    }
    
    public function currency(): Currency
    {
        return new USD();
    }
    
    public function scale(): int
    {
        return 2;
    }

}
```

You are free to use those objects in any out-of-the-box or custom operations.
Let's take a look at the following example: you need some tax which is `10%` of the given amount but not less than `$2`.

This is real object-oriented solution:

```php
<?php

declare(strict_types=1);

use ElegantBro\Money\ArrayLot;
use ElegantBro\Money\Money;
use ElegantBro\Money\Operations\MaxOf;
use ElegantBro\Money\Operations\Multiplied;
use ElegantBro\Money\Wrapper;

final class Tax extends Wrapper
{
    public function __construct(Money $origin, Money $minTax)
    {  
        $this->is(
            new MaxOf(
                new ArrayLot(
                    Multiplied::keepScale($origin, '0.1'),
                    $minTax
                ),
                $origin->scale()
            )
        );
    }
}

// on the client side
$tax = new Tax(
    new UserBalance($uuid, $pdo),
    new TwoDollars()
);
```

This is a shiny declarative code, but the biggest advantage is laziness. No one calculation will happen until the `amount` method will be called.

Using procedural implementation like [`moneyphp/money`](https://github.com/moneyphp/money)
you have to create some sort of ugly `MoneyHelper` with static `tax` method:

```php
<?php

declare(strict_types=1);

use Money/Money;

class MoneyHelper
{
    public static function tax(Money $amount, Money $minTax): Money
    {
        return Money::max(
            $amount->multiply('0.1'),
            $minTax
        );
    }
    
    // usually helpers contain dozens of static methods
}

// on the client side
$tax = MoneyHelper::tax(
    $userBalance, // you should fetch user balance from the database before
    Money::USD(200)
);
```

It is quite possible that this result will not be needed in the subsequent calculation. For example, there is some
tax-free condition, and you should check it before the tax calculation to avoid unnecessary DB-request and end up
with temporal coupling.

## Installation

```bash
$ composer require elegant-bro/money
```

## For contributors

**Pass all tests locally before creating the pull request.**

Build the test container and run all tests
```shell
make all
```

Other commands
```shell
# build the Dockerfile
make build 

# install composer requirements
make install

# enter the container shell
make shell

# style check
make style-check

# run unit tests
make unit

# ensure coverage is 100%
make coverage
```

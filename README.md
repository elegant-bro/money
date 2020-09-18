[![Build Status](https://travis-ci.com/elegant-bro/money.svg?branch=master)](https://travis-ci.com/elegant-bro/money)
[![Coverage Status](https://coveralls.io/repos/github/elegant-bro/money/badge.svg?branch=master)](https://coveralls.io/github/elegant-bro/money?branch=master)

# Tests

#### Build container

`docker build --build-arg VERSION=7.4 --tag elegant-bro/money:7.4 ./docker/`

#### Install dependencies

`docker run --rm -ti -v $PWD:/app elegant-bro/money:7.4 composer install`

#### Run tests

`docker run --rm -ti -v $PWD:/app -w /app elegant-bro/money:7.4 vendor/bin/phpunit`

### Ensure coverage is 100%
`docker run --rm -ti -v $PWD:/app -w /app elegant-bro/money:7.4 php check-coverage.php build/logs/clover.xml 100`

#### Test code style
`docker run --rm -ti -v $PWD:/app -w /app elegant-bro/money:7.4 vendor/bin/ecs --level psr12 check src`
